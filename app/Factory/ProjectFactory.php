<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;

class ProjectFactory
{
    private $typeId;
    private $title;
    private $creationDate;
    private $signingTheContract;
    private $deadline;
    private $chainStores;
    private $hasOutsource;
    private $hasInvestors;
    private $deliveryOnTime;
    private $firstStepPayment;
    private $secondStepPayment;
    private $thirdStepPayment;
    private $fourthStepPayment;
    private $workerCount;
    private $serviceCount;
    private $comment;
    private $performanceIndicator;

    /**
     * @param $typeId
     * @param $title
     * @param $creationDate
     * @param $signingTheContract
     * @param $deadline
     * @param $chainStores
     * @param $hasOutsource
     * @param $hasInvestors
     * @param $deliveryOnTime
     * @param $firstStepPayment
     * @param $secondStepPayment
     * @param $thirdStepPayment
     * @param $fourthStepPayment
     * @param $workerCount
     * @param $serviceCount
     * @param $comment
     * @param $performanceIndicator
     */
    public function __construct($typeId, $title, $creationDate, $signingTheContract, $deadline, $chainStores,
                                $hasOutsource, $hasInvestors, $deliveryOnTime, $firstStepPayment, $secondStepPayment,
                                $thirdStepPayment, $fourthStepPayment, $workerCount, $serviceCount, $comment,
                                $performanceIndicator)
    {
        $this->typeId = $typeId;
        $this->title = $title;
        $this->creationDate = $creationDate;
        $this->signingTheContract = $signingTheContract;
        $this->deadline = $deadline;
        $this->chainStores = $chainStores;
        $this->hasOutsource = $hasOutsource;
        $this->hasInvestors = $hasInvestors;
        $this->deliveryOnTime = $deliveryOnTime;
        $this->firstStepPayment = $firstStepPayment;
        $this->secondStepPayment = $secondStepPayment;
        $this->thirdStepPayment = $thirdStepPayment;
        $this->fourthStepPayment = $fourthStepPayment;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->comment = $comment;
        $this->performanceIndicator = $performanceIndicator;
    }

    public static function make($map, $row)
    {
        return new self(
            self::getTypeId($map, $row['tip']),
                $row['naimenovanie'],
                self::transformDate($row['data_sozdaniia']),
                self::transformDate($row['podpisanie_dogovora']),
                self::transformDate($row['dedlain']),
                self::formatBool($row['setevik']),
                self::formatBool($row['nalicie_autsorsinga']),
                self::formatBool($row['nalicie_investorov']),
                self::formatBool($row['sdaca_v_srok']),
                $row['vlozenie_v_pervyi_etap'] ?? null,
                $row['vlozenie_vo_vtoroi_etap'] ?? null,
                $row['vlozenie_v_tretii_etap'] ?? null,
                $row['vlozenie_v_cetvertyi_etap'] ?? null,
                $row['kolicestvo_ucastnikov'] ?? null,
                $row['kolicestvo_uslug'] ?? null,
                $row['kommentarii'] ?? null,
                $row['znacenie_effektivnosti'] ?? null,
        );
    }

    private static function getTypeId($map, $title)
    {
        return isset($map[$title]) ? $map[$title] : Type::create(['title' => $title])->id;
    }

    private static function formatBool($value)
    {
        return $value === 'Да';
    }

    private static function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function getValues()
    {
        $props = get_object_vars($this);
        $res = [];
        foreach ($props as $key => $prop) {
            $res[Str::snake($key)] = $prop;
        }
        return $res;
    }
}
