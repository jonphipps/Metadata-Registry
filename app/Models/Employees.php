<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-01-01
 * Time: 2:04 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * App\Models\Employees
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders[] $latestOrders
 * @property-read string $full_name
 * @mixin \Eloquent
 */
class Employees extends Model
{

    public $timestamps = false;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $appends = [ 'full_name' ];

  /**
   * @var array
   */
    protected $fillable = [
      'company',
      'last_name',
      'first_name',
      'email_address',
      'job_title',
      'business_phone',
      'home_phone',
      'mobile_phone',
      'fax_number',
      'address',
      'city',
      'state_province',
      'zip_postal_code',
      'country_region',
      'web_page',
      'notes',
      'attachments',
    ];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
    public function latestOrders()
    {
        return $this->hasMany(Orders::class, 'employee_id')->limit(10);
    }


  /**
   * @return string
   */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
