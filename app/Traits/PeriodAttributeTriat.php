<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait PeriodAttributeTriat {
    protected $default = '--:--';

    public function total() {
        $nt = 0;
        $ot = 0;
        $default = false;
        $rule = (30 - 30) * 60;//min of duration that will count as an hour
        $p1_out = strtotime( $this->p1_out );
        $p1_in = strtotime( $this->p1_in );
        $p2_out = strtotime( $this->p2_out );
        $p2_in = strtotime( $this->p2_in );
        $p3_out = strtotime( $this->p3_out );
        $p3_in = strtotime( $this->p3_in );

        //morning
        if ( $p1_in < $p1_out & $p1_in != $default ) {
            $nt += round(($p1_out - $p1_in - $rule) / 3600);
        }

        //afternoon
        if ( $p2_in < $p2_out & $p2_in != $default ) {
            $nt += round(($p2_out - $p2_in - $rule) / 3600);
        }

        //ot
        if ($p3_out < $p3_in & $p3_out != $default ) {
            $p3_out += 24 * 3600;
        }
        if ( $p3_in < $p3_out & $p3_in != $default ) {
            $ot = round(($p3_out - $p3_in - $rule) / 3600);
        }

        $this->nt = $nt;
        $this->ot = $ot;
        $this->nt_x_rate = $nt;
        $this->ot_x_rate = $ot + intval($ot/3);
        $this->nt_amount = $this->wage->hour * $this->nt_x_rate;
        $this->ot_amount = $this->wage->hour * $this->ot_x_rate;
    }

    public function getTotalDurationAttribute()
    {
        return $this->nt_x_rate + $this->ot_x_rate;
    }

    public function getTotalAmountAttribute()
    {
        return $this->nt_amount + $this->ot_amount;
    }


    //setter getter

    public function getP1InAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return  $this->default;
    }

    public function setP1InAttribute($value)
    {
        $this->attributes['p1_in'] = $value;
        if ($value == $this->default) {
            $this->attributes['p1_in'] = null;
        }
    }
    
    public function getP1OutAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return  $this->default;
    }

    public function setP1OutAttribute($value)
    {
        $this->attributes['p1_out'] = $value;
        if ($value == $this->default) {
            $this->attributes['p1_out'] = null;
        }
    }

    public function getP2InAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return $this->default;
    }

    public function setP2InAttribute($value)
    {
        $this->attributes['p2_in'] = $value;
        if ($value == $this->default) {
            $this->attributes['p2_in'] = null;
        }
    }

    public function getP2OutAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return $this->default;
    }

    public function setP2OutAttribute($value)
    {
        $this->attributes['p2_out'] =  $value;
        if ($value == $this->default) {
            $this->attributes['p2_out'] = null;
        }
    }

    public function getP3InAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return $this->default;
    }

    public function setP3InAttribute($value)
    {
        $this->attributes['p3_in'] =  $value;
        if ($value == $this->default) {
            $this->attributes['p3_in'] = null;
        }
    }

    public function getP3OutAttribute($value)
    {
        if ($value) {
            return date('H:i', strtotime($value));
        }
        return $this->default;
    }

    public function setP3OutAttribute($value)
    {
        $this->attributes['p3_out'] =  $value;
        if ($value == $this->default) {
            $this->attributes['p3_out'] = null;
        }
    }
}