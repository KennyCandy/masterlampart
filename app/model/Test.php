<?php
/**
 * Created by PhpStorm.
 * User: quoc_trinh
 * Date: 01/12/2016
 * Time: 14:27
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
	public $name;
	public $timestamps=[];
	protected $fillable = ['username'];

}