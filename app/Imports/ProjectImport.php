<?php

namespace App\Imports;

use App\Factory\ProjectDynamicFactory;
use App\Factory\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProjectImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    private Task $task;

    /**
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        $typesMap = $this->getTypesMap(Type::all());

        foreach ($collection as $row) {
            if (!isset($row['naimenovanie'])) continue;

            $projectFactory = ProjectFactory::make($typesMap, $row);

            Project::updateOrCreate(
                [
                    'type_id' => $projectFactory->getValues()['type_id'],
                    'title' => $projectFactory->getValues()['title'],
                    'creation_date' => $projectFactory->getValues()['creation_date'],
                    'signing_the_contract' => $projectFactory->getValues()['signing_the_contract'],
                ],

                $projectFactory->getValues());
        }
    }

    private function getTypesMap($types): array
    {
        $map = [];
        foreach ($types as $type) {
            $map[$type->title] = $type->id;
        }

        return $map;
    }

    public function rules(): array
    {
        return [
            'tip' => 'required|string',
            'naimenovanie' => 'required|string',
            'data_sozdaniia' => 'required|integer',
            'podpisanie_dogovora' => 'required|integer',
            'dedlain' => 'nullable|integer',
            'setevik' => 'nullable|string',
            'nalicie_autsorsinga' => 'nullable|string',
            'nalicie_investorov' => 'nullable|string',
            'sdaca_v_srok' => 'nullable|string',
            'vlozenie_v_pervyi_etap' => 'nullable|integer',
            'vlozenie_vo_vtoroi_etap' => 'nullable|integer',
            'vlozenie_v_tretii_etap' => 'nullable|integer',
            'vlozenie_v_cetvertyi_etap' => 'nullable|integer',
            'kolicestvo_ucastnikov' => 'nullable|integer',
            'kolicestvo_uslug' => 'nullable|integer',
            'kommentarii' => 'nullable|string',
            'znacenie_effektivnosti' => 'nullable|numeric',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        processFailures($failures, $this->attributesMap(), $this->task);
    }

//    public function customValidationMessages(): array
//    {
//
//    }

    private function attributesMap()
    {
        return [
            'tip' => 'Тип',
            'naimenovanie' => 'Наименование',
            'data_sozdaniia' => 'Дата создания',
            'podpisanie_dogovora' => 'Подписание договора',
            'dedlain' => 'Дедлайн',
            'setevik' => 'Сетевик',
            'nalicie_autsorsinga' => ' Наличие аутсорсинга',
            'nalicie_investorov' => 'Наличие инвесторов',
            'sdaca_v_srok' => 'Сдача в срок',
            'vlozenie_v_pervyi_etap' => 'Вложение в первый этап',
            'vlozenie_vo_vtoroi_etap' => 'Вложение во второй этап',
            'vlozenie_v_tretii_etap' => 'Вложение в третий этап',
            'vlozenie_v_cetvertyi_etap' => 'Вложение в четвертый этап',
            'kolicestvo_ucastnikov' => 'Количество участников',
            'kolicestvo_uslug' => 'Количество услуг',
            'kommentarii' => 'Комментарий',
            'znacenie_effektivnosti' => 'Значение эффективности',
        ];
    }
}
