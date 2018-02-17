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
        $class         = static::class;
        $classUser     = $class . 'User';
        $className     = $this->get_class_name($class);
        $foreignKey    = ['Vocabulary'=> 'vocabulary_id', 'Elementset' => 'schema_id', 'Project' => 'agent_id'];

        return $this->belongsToMany(
            User::class,
            $classUser::TABLE,
            $foreignKey[$className],
            'user_id'
        )->withTimestamps()->withPivot(
            'is_maintainer_for',
            'is_registrar_for',
            'is_admin_for',
            'languages',
            'default_language',
            'current_language'
        );
    }

    /**
     * @return mixed
     */
    public function registrar()
    {
        return $this->members()->where('is_registrar_for', true);
    }

    /**
     * @return mixed
     */
    public function administrators()
    {
        return $this->members()->where('is_admin_for', true);
    }

    /**
     * @return mixed
     */
    public function languageMaintainers()
    {
        return $this->members()->where('is_maintainer_for', true)->whereNotNull('languages');
    }

    /**
     * @return mixed
     */
    public function maintainersForLanguage($language)
    {
        return $this->members()
            ->where('is_maintainer_for', true)
            ->whereNotNull('languages')
            ->whereIn('languages', $language);
    }

    /**
     * @return mixed
     */
    public function maintainers()
    {
        return $this->members()->where('is_maintainer_for', true)->whereNull('languages');
    }

    /**
     * @return mixed
     */
    public function viewers()
    {
        return $this->members()->whereNull('is_admin_for', true)->whereNull('is_maintainer_for');
    }

    private function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) {
            return substr($classname, $pos + 1);
        }

        return $pos;
    }
}
