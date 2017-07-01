<?php

namespace App\Http\Controllers\Admin;

use App\Models\Renewal;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\RenewalRequest as StoreRequest;
use App\Http\Requests\RenewalRequest as UpdateRequest;
use Carbon\Carbon;

class RenewalCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Renewal');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/renewal');
        $this->crud->setEntityNameStrings('renewal', 'renewals');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([  // Select2
            'label' => "License",
            'type' => 'select2',
            'name' => 'license_id', // the db column for the foreign key
            'entity' => 'license', // the method that defines the relationship in your Model
            'attribute' => 'licenseOwner', // foreign key attribute that is shown to user
            'model' => "App\Models\License" // foreign key model
        ], 'update/create/both');


        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        $this->crud->removeFields(['expire_date'], 'update/create/both');
        $this->crud->addField([  // Select2
            'label' => "Date",
            'type' => 'date_picker',
            'name' => 'date', // the db column for the foreign key

            'date_picker_options' => [
                'todayBtn' => 'linked',
                'format' => 'dd-mm-yyyy',
                'autoclose'=> true
            ],

        ], 'create/update/both')->beforeField('note');

        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->removeColumn('date'); // remove a column from the stack
         $this->crud->addColumn([  // Select2
             'label' => "Registered Date",
             'type' => 'text',
             'name' => 'ShowDate', // the db column for the foreign key
             // foreign key model
         ])->beforeColumn('note'); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack

        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
         $this->crud->setColumnDetails('license_id', [  // Select2
             'label' => "License",
             'type' => 'select',
             'name' => 'license_id', // the db column for the foreign key
             'entity' => 'license', // the method that defines the relationship in your Model
             'attribute' => 'licenseOwner', // foreign key attribute that is shown to user
             'model' => "App\Models\License" // foreign key model
         ]); // adjusts the properties of the passed in column (by name)


        $this->crud->setColumnDetails('expire_date', [  // Select2
            'label' => "Expire Date",
            'type' => 'text',
            'name' => 'expire_date', // the db column for the foreign key
            // foreign key model
        ]);


        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, 'button', $content, $position); // add a button; possible types are: view, model_function
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
         $this->crud->orderBy("id","DESC");
        // $this->crud->groupBy();
        // $this->crud->limit();
    }


    public function store(StoreRequest $request)
    {
         $request->request->add(["expire_date"=>Carbon::parse($request->input('date'))->addYear()->toDateString()]);

        Renewal::create($request->all());
        //return $request->all();
        //return $request->input('date');
        //return Carbon::parse($request->input('date'))->addYear()->toDateString();
        //return Carbon::createFromFormat('d-m-Y', $request->input('date'))->toDateString();
        //Carbon::parse()$request->input('date');
        // your additional operations before save here
        //$redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return redirect()->back();
    }

    public function update(UpdateRequest $request)
    {
        // $request->all();

        $request->request->add(["expire_date"=>Carbon::parse($request->input('date'))->addYear()->toDateString()]);
        // $request->all();
         Renewal::find($request->input('id'))->update(["date"=>$request->input("date"),"note"=>$request->input("note"),"expire_date"=>$request->input("expire_date")]);
        // your additional operations before save here
        //$redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        //return $redirect_location;
        return redirect("admin/renewal");
    }
}
