<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\User;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles)
    {
        $user = Auth::user();
        $projectId = $request->route('id');

//        dd([
//            'User ID' => $user->id,
//            'Project ID' => $projectId,
//            'Allowed Roles' => $allowedRoles,
//        ]);

        // Check user role and lead developer status
        if (in_array($user->userLevel, $allowedRoles) || in_array('lead_developer', $allowedRoles) && $this->isLeadDeveloper($user->id, $projectId)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

        /**
         * Check if the user is the lead developer for the given project.
         *
         * @param int $userId
         * @param int $projectId
         * @return bool
         */
    private function isLeadDeveloper($userId, $projectId)
    {
        // Check if the user is the lead developer for the project
        return Project::where('id', $projectId)
            ->where('lead_developer_id', $userId)
            ->exists();
    }

}
