<?php

namespace App\GraphQL\Queries;

use App\Models\Project;

final class OwnProjects
{
    protected int $user_id;

    public function __construct()
    {
        $this->user_id = auth()->user()->getAuthIdentifier();
        if(!$this->user_id) {
            return response()->json(['error' => 'Not Authorized'], 403);
        }
    }

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function resolve($_, array $args): array
    {
        /**
        {
            ownProjects {
                name
                description
            }
        }
         */
        return Project::where('user_id', $this->user_id)->get()->all();
    }

    public function count(): int
    {
        /**
        query {
            ownProjectsCount
        }
         */
        return Project::where('user_id', $this->user_id)->count();
    }
}
