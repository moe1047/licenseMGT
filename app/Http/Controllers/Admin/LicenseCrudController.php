<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\LicenseRequest as StoreRequest;
use App\Http\Requests\LicenseRequest as UpdateRequest;

class LicenseCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\License');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/license');
        $this->crud->setEntityNameStrings('license', 'licenses');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([   // date_picker
            'name' => 'date',
            'type' => 'date_picker',
            'label' => 'Date',
            // optional:
            'date_picker_options' => [
                'todayBtn' => true,
                'format' => 'dd-mm-yyyy',
                'language' => 'en'
            ],
        ], 'update/create/both');

        $this->crud->addField(['label' => "Business Name",
            'type' => 'text',
            'name' => 'business_name', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Establishment Year",
            'type' => 'number',
            'name' => 'establishment_year', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Operation Site",
            'type' => 'text',
            'name' => 'operation_site', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Owner",
            'type' => 'text',
            'name' => 'owner', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Business Type",
            'type' => 'select2_multiple',
            'name' => 'businessTypes', // the method that defines the relationship in your Model
            'entity' => 'businessTypes', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\BusinessType", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ], 'update/create/both');
        $this->crud->addField(['label' => "Owner Tell 1",
            'type' => 'text',
            'name' => 'owner_tell_1', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Owner Tell 2",
            'type' => 'text',
            'name' => 'owner_tell_2', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Owner Email",
            'type' => 'text',
            'name' => 'owner_email', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Contact Person",
            'type' => 'text',
            'name' => 'contact_person', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Contact Person Tell 1",
            'type' => 'text',
            'name' => 'contact_person_tell_1', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Contact Person Tell 2",
            'type' => 'text',
            'name' => 'contact_person_tell_2', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Contact Person Email",
            'type' => 'text',
            'name' => 'contact_person_email', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Applicant Name",
            'type' => 'text',
            'name' => 'applicant_name', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ]
        ], 'update/create/both');


        $this->crud->addField(['label' => "Applicant Tell 1",
            'type' => 'text',
            'name' => 'applicant_tell_1', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Applicant Tell 2",
            'type' => 'text',
            'name' => 'applicant_tell_2', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Applicant Tell 4",
            'type' => 'text',
            'name' => 'applicant_tell_3', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Applicant Email",
            'type' => 'text',
            'name' => 'application_email', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Permanent Address",
            'type' => 'text',
            'name' => 'permenant_address', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ]
        ], 'update/create/both');

        $this->crud->addField(['label' => "Bank Guarantee",
            'type' => 'text',
            'name' => 'bank_guarantee', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => 'Ref No.',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Business Charter",
            'type' => 'text',
            'name' => 'business_charter', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => 'Ref No.',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Attorney General Registration Letter",
            'type' => 'text',
            'name' => 'attorny_general_registration_letter', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => 'Ref No.',
                'class' => 'form-control some-class'
            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ]
        ], 'update/create/both');
        $this->crud->addField(['label' => "Ownership Document",
            'type' => 'checkbox',
            'name' => 'ownership_document', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => '',
                'class' => ''

            ], // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ]
        ], 'update/create/both');

        $this->crud->addField([
            'name'        => 'operation_status', // the name of the db column
            'label'       => 'Operation Status', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                'new' => "New",
                'operational' => "Operational"

            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ], 'update/create/both');
        $this->crud->addField([
            'name'        => 'ownership', // the name of the db column
            'label'       => 'Ownership', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                'personal' => "Personal",
                'partnership' => "Partnership",
                'corporation' => "Corporation"

            ],
            // optional
            //'inline'      => false, // show the radios all on the same line?
        ], 'update/create/both');
        $this->crud->addField([
            'name'        => 'serial', // the name of the db column
            'label'       => 'Serial', // the input label
            'type'        => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ]

            // optional
            //'inline'      => false, // show the radios all on the same line?
        ], 'update/create/both');

        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
         //$this->crud->removeFields(['',''], 'update/create/both');


        // ------ CRUD COLUMNS
         $this->crud->addColumn([       // Select2Multiple = n-n relationship (with pivot table)
             'label' => "Business Type",
             'type' => 'select_multiple',
             'name' => 'businessTypes', // the method that defines the relationship in your Model
             'entity' => 'businessTypes', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user
             'model' => "App\Models\BusinessType" // foreign key model
              // on create&update, do you need to add/delete pivot table entries?
         ]); // add a single column, at the end of the stack

         //$this->crud->addColumns(['']); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
         $this->crud->setColumnDetails('business_name', ['label' => 'Name']); // adjusts the properties of the passed in column (by name)
        $this->crud->setColumnDetails('establishment_year', ['label' => 'E.year']);
        $this->crud->setColumnDetails('operation_site', ['label' => 'Site']);
        $this->crud->setColumnDetails('business_name', ['label' => 'Name']);

        $this->crud->setColumnDetails('date', ['label' => 'Date','type']);
        $this->crud->enableExportButtons();
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
         $this->crud->orderBy('id','DESC');
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        $this->validate($request,[
            'serial'=> 'required|unique:licenses,serial,'.$request->input("id")
        ]);
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
