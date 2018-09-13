<?php

namespace App\Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Delete;
use SleepingOwl\Admin\Form\Buttons\Cancel;

/**
 * Class Sport_clubs
 *
 * @property \App\Sport_club $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Professions extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Профессии';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setDisplaySearch(true)->setColumns([
            AdminColumn::link('id_professionals')->setLabel('ID'),
            AdminColumn::link('title')->setLabel('Название')


          //  AdminColumn::text('gender', 'Пол'),

         //   AdminColumn::text('level', 'Категория')
        


            
        ]);

        $display->paginate(200);

        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {




        $formPrimary = 

        AdminForm::panel()->addBody(
            AdminFormElement::text('id_professionals')->setLabel('ID Профессии'),
            AdminFormElement::text('title')->setLabel('Название'),       
            
            AdminFormElement::select('gender', 'Пол', [
                 0 => 'Нет',
                 1 => 'М',
                 2 => 'Ж'
             ])->nullable()->required(),
            

            
                AdminFormElement::select('level', 'Категория', [
                 0 => 'Нет',
                 1 => '1',
                 2 => '2',
                 3 => '3'
             ])->nullable()->required(),

AdminFormElement::html('<hr>'),


            AdminFormElement::text('id_cat_1', '1 Достижение')->setDefaultValue('1'),
            AdminFormElement::text('factor_cat_1', 'Фактор темы 1')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_1', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_1', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_2', '2 Катализатор')->setDefaultValue('2'),
            AdminFormElement::text('factor_cat_2', 'Фактор темы 2')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_2', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_2', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_3', '3 Приспособляемость')->setDefaultValue('3'),
            AdminFormElement::text('factor_cat_3', 'Фактор темы 3')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_3', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_3', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_4', '4 Аналитик')->setDefaultValue('4'),
            AdminFormElement::text('factor_cat_4', 'Фактор темы 4')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_4', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_4', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_5', '5 Организатор')->setDefaultValue('5'),
            AdminFormElement::text('factor_cat_5', 'Фактор темы 5')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_5', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_5', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_6', '6 Убеждение')->setDefaultValue('6'),
            AdminFormElement::text('factor_cat_6', 'Фактор темы 6')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_6', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_6', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_7', '7 Распорядитель ')->setDefaultValue('7'),
            AdminFormElement::text('factor_cat_7', 'Фактор темы 7')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_7', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_7', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_8', '8 Коммуникация')->setDefaultValue('8'),
            AdminFormElement::text('factor_cat_8', 'Фактор темы 8')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_8', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_8', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_9', '9 Конкуренция')->setDefaultValue('9'),
            AdminFormElement::text('factor_cat_9', 'Фактор темы 9')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_9', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_9', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_10', '10 Взаимосвязанность')->setDefaultValue('10'),
            AdminFormElement::text('factor_cat_10', 'Фактор темы 10')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_10', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_10', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_11', '11 Контекст')->setDefaultValue('11'),
            AdminFormElement::text('factor_cat_11', 'Фактор темы 11')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_11', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_11', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_12', '12 Осмотрительность')->setDefaultValue('12'),
            AdminFormElement::text('factor_cat_12', 'Фактор темы 12')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_12', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_12', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_13', '13 Развитие')->setDefaultValue('13'),
            AdminFormElement::text('factor_cat_13', 'Фактор темы 13')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_13', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_13', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_14', '14 Дисциплинированность ')->setDefaultValue('14'),
            AdminFormElement::text('factor_cat_14', 'Фактор темы 14')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_14', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_14', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_15', '15 Эмпатия')->setDefaultValue('15'),
            AdminFormElement::text('factor_cat_15', 'Фактор темы 15')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_15', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_15', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_16', '16 Последовательность ')->setDefaultValue('16'),
            AdminFormElement::text('factor_cat_16', 'Фактор темы 16')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_16', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_16', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_17', '17 Сосредоточенность')->setDefaultValue('17'),
            AdminFormElement::text('factor_cat_17', 'Фактор темы 17')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_17', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_17', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_18', '18 Будущее')->setDefaultValue('18'),
            AdminFormElement::text('factor_cat_18', 'Фактор темы 18')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_18', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_18', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_19', '19 Гармония')->setDefaultValue('19'),
            AdminFormElement::text('factor_cat_19', 'Фактор темы 19')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_19', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_19', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_20', '20 Генератор идей')->setDefaultValue('20'),
            AdminFormElement::text('factor_cat_20', 'Фактор темы 20')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_20', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_20', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_21', '21 Включенность')->setDefaultValue('21'),
            AdminFormElement::text('factor_cat_21', 'Фактор темы 21')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_21', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_21', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_22', '22 Индивидуализация')->setDefaultValue('22'),
            AdminFormElement::text('factor_cat_22', 'Фактор темы 22')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_22', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_22', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_23', '23 Вклад')->setDefaultValue('23'),
            AdminFormElement::text('factor_cat_23', 'Фактор темы 23')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_23', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_23', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_24', '24 Мышление')->setDefaultValue('24'),
            AdminFormElement::text('factor_cat_24', 'Фактор темы 24')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_24', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_24', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_25', '25 Ученик')->setDefaultValue('25'),
            AdminFormElement::text('factor_cat_25', 'Фактор темы 25')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_25', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_25', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_26', '26 Максимизатор')->setDefaultValue('26'),
            AdminFormElement::text('factor_cat_26', 'Фактор темы 26')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_26', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_26', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_27', '27 Позитивность')->setDefaultValue('27'),
            AdminFormElement::text('factor_cat_27', 'Фактор темы 27')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_27', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_27', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_28', '28 Отношения')->setDefaultValue('28'),
            AdminFormElement::text('factor_cat_28', 'Фактор темы 28')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_28', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_28', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_29', '29 Ответственность')->setDefaultValue('29'),
            AdminFormElement::text('factor_cat_29', 'Фактор темы 29')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_29', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_29', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_30', '30 Восстановление')->setDefaultValue('30'),
            AdminFormElement::text('factor_cat_30', 'Фактор темы 30')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_30', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_30', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_31', '31 Уверенность')->setDefaultValue('31'),
            AdminFormElement::text('factor_cat_31', 'Фактор темы 31')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_31', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_31', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_32', '32 Значимость')->setDefaultValue('32'),
            AdminFormElement::text('factor_cat_32', 'Фактор темы 32')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_32', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_32', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),

            AdminFormElement::text('id_cat_33', '33 Стратегия ')->setDefaultValue('33'),
            AdminFormElement::text('factor_cat_33', 'Фактор темы 33')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_33', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_33', 'Значение до')->setDefaultValue('НЕТ'),

AdminFormElement::html('<hr>'),


            AdminFormElement::text('id_cat_34', '34 Обаяние')->setDefaultValue('34'),
            AdminFormElement::text('factor_cat_34', 'Фактор темы 34')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_from_cat_34', 'Значение от')->setDefaultValue('НЕТ'),
            AdminFormElement::text('value_before_cat_34', 'Значение до')->setDefaultValue('НЕТ')


            

  

        );
        $formPrimary->getButtons()->replaceButtons([
                'delete' => null,
                'save'   => (new SaveAndClose()),
                'cancel'  => (new Cancel()),
            ]);

         return  $formPrimary;




    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
}
