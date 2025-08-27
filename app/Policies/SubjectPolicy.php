<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use App\Models\SubjectPermission;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subject $subject): bool
    {
		if($subject->view_perm!=1){
			return true;
		}
      return SubjectPermission::where('user_id', $user->id)
						->where('subject_id', $subject->id)
						//->where('post_id', $post->id)
						->where('can_view', true)
						->exists();
   /*  return $post->permissions()
        ->where('user_id', $user->id)
        ->where('can_view', true)
        ->exists(); */
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Subject $subject): bool
    {
		if($subject->post_perm!=1){
			return true;
		}
		return SubjectPermission::where('user_id', $user->id)
						->where('subject_id', $subject->id) 
						->where('can_post', true)
						->exists();
		 
      //  return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subject $subject): bool
    {
        return false;
    }
	
	 public function comment(User $user, Subject $subject): bool
    {
		if($subject->comment_perm!=1){
			return true;
		}
		
       return SubjectPermission::where('user_id', $user->id)
						->where('subject_id', $subject->id)
					 
						->where('can_comment', true)
						->exists();
    }
	
}
