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
class Issues extends Section
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
    protected $title = 'Вопросы';

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
            AdminColumn::link('id')->setLabel('ID')->setWidth('400px'),
            AdminColumn::link('title')->setLabel('Название')->setWidth('400px'),
            AdminColumn::text('description', 'Описание'),
            AdminColumn::text('categories.title', 'Категории')




        


            
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
            AdminFormElement::text('id', 'ID')->required(),
            AdminFormElement::text('title', 'Название')->required(),
            
        AdminFormElement::select('categories_id')->setLabel('Тема вопроса')
                ->setModelForOptions(\App\Categories::class)
                
                ->setDisplay('title')
                ->required()
                ->setHtmlAttribute('style', 'width: 100%'),

                AdminFormElement::textarea('description', 'Описание')->required()
                

  

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
