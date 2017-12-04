<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasMembers
{
    /**
     * @return BelongsToMany
     */
    public function members(): ?BelongsToMany
    {
        //determine the parent class
        $class = $this->getMorphClass();
        $classUser = $class . 'User';
        $className     = $this->get_class_name( $class );
        $foreignKey = ['Vocabulary'=> 'vocabulary_id', 'Elementset' => 'schema_id', 'Project' => 'agent_id'];

        return $this->belongsToMany( User::class,
            $classUser::TABLE,
            $foreignKey[$className],
            'user_id' )->withTimestamps()->withPivot( 'is_maintainer_for',
            'is_registrar_for',
            'is_admin_for',
            'languages',
            'default_language',
            'current_language' );
    }

    private function get_class_name( $classname )
    {
        if ( $pos = strrpos( $classname, '\\' ) ) {
            return substr( $classname, $pos + 1 );
        }

        return $pos;
    }
}
