<?php

namespace App\Http\Controllers\Admin;

use App\Models\DailyOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Helpers\Helper;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DailyOperationRequest as StoreRequest;
use App\Http\Requests\DailyOperationRequest as UpdateRequest;
use Carbon\Carbon;

class DailyOperationCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\DailyOperation');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/dailyOperation');
        $this->crud->setEntityNameStrings('daily Operation', 'daily operations');

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
        ], 'update');

        // ------ CRUD FIELDS
        //$this->crud->removeField('date', 'update');
        $this->crud->addField([  // Select2
            'label' => "Weather Forecast",
            'type' => 'text',
            'name' => 'weather_forecast', // the db column for the foreign key
            // helpful text, show up after input
            'attributes' => [
                'placeholder' => 'dhexdhexaad / kacsan / degan',
                'class' => 'form-control some-class'
            ], // foreign key model
        ], 'update');



         $this->crud->addField([  // Select2
             'label' => "Town",
             'type' => 'select2',
             'name' => 'town_id', // the db column for the foreign key
             'entity' => 'town', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user
             'model' => "App\Models\Town" // foreign key model
         ], 'update');

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Locations",
            'type' => 'select2_multiple',
            'name' => 'locations', // the method that defines the relationship in your Model
            'entity' => 'locations', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\location", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ], 'update/create/both');
        $this->crud->addField([  // Select2
            'label' => "Fish 1",
            'type' => 'select2',
            'name' => 'fish_id_1', // the db column for the foreign key
            'entity' => 'fish', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Fish" // foreign key model
        ], 'update');
        $this->crud->addField([  // Select2
            'label' => "Fish 2",
            'type' => 'select2',
            'name' => 'fish_id_2', // the db column for the foreign key
            'entity' => 'fish', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Fish" // foreign key model
        ], 'update');
        $this->crud->addField([  // Select2
            'label' => "Fish 3",
            'type' => 'select2',
            'name' => 'fish_id_3', // the db column for the foreign key
            'entity' => 'fish', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Fish" // foreign key model
            ,'wrapperAttributes' => [
            'class' => 'form-group col-md-12']

        ], 'update');
        $this->crud->addField([  // Select2
            'label' => "Ship",
            'type' => 'select2',
            'name' => 'ship_id', // the db column for the foreign key
            'entity' => 'ship', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Ship" // foreign key model

        ], 'update');

        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
         $this->crud->addColumn(['label' => "Ship",
             'type' => 'select',
             'name' => 'ship', // the db column for the foreign key
             'entity' => 'ship', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user
             'model' => "App\Models\Ship" ]); // add a single column, at the end of the stack
        $this->crud->addColumn([  // Select2
            'label' => "Town",
            'type' => 'select',
            'name' => 'town', // the db column for the foreign key
            'entity' => 'town', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Town" // foreign key model
        ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => "Locations", // Table column heading
            'type' => "select_multiple",
            'name' => 'locations', // the method that defines the relationship in your Model
            'entity' => 'locations', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Location", // foreign key model
        ]);
        $this->crud->removeColumn('date'); // remove a column from the stack
        $this->crud->addColumn([  // Select2
            'label' => "Registered Date",
            'type' => 'text',
            'name' => 'ShowDate', // the db column for the foreign key
            // foreign key model
        ])->beforeColumn('weather_forecast');



        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        $this->crud->removeColumns(['ship_id', 'town_id', 'town_id']); // remove an array of columns from the stack
        $this->crud->setColumnDetails('days_spent_in_the_sea', ['label' => 'Days in sea']); // adjusts the properties of the passed in column (by name)
        $this->crud->setColumnDetails('weather_forecast', ['label' => 'forecast']);
        $this->crud->setColumnDetails('number_of_nets', ['label' => 'No. of nets']);
        $this->crud->setColumnDetails('production_amount', ['label' => 'prod amount']);


        $this->crud->setColumnDetails('fish_id_2', ['label' => 'Fish 2','type'=>'select','entity'=>'fish1','attribute' => 'name','model' => "App\Models\Fish"]);
        $this->crud->setColumnDetails('fish_id_1', ['label' => 'Fish 1','type'=>'select','entity'=>'fish2','attribute' => 'name','model' => "App\Models\Fish"]);
        $this->crud->setColumnDetails('fish_id_3', ['label' => 'Fish 3','type'=>'select','entity'=>'fish3','attribute' => 'name','model' => "App\Models\Fish"]);

        $this->crud->setColumnDetails('amount_fish_1', ['label' => 'Amount']);
        $this->crud->setColumnDetails('amount_fish_2', ['label' => 'Amount']);
        $this->crud->setColumnDetails('amount_fish_3', ['label' => 'Amount']);
        $this->crud->setColumnDetails('date', ['label' => 'Date','type'=>'date']);


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
        //$this->crud->enableReorder('date', 0);
        //$this->crud->allowAccess('reorder');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
         //$this->crud->enableReorder('date', MAX_TREE_LEVEL);
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
        $this->crud->setCreateView('daily_operations.create');
    }
    public function create()
    {
        $fishes= Helper::fishesDropDown();
        $locations= Helper::locationDropDown();
        $towns= Helper::townsDropDown();
        $ships= Helper::shipsDropDown();
        return view("daily_operations.create",compact('fishes','locations','towns','ships'));
    }

    public function store(StoreRequest $request)
    {
        //return $request->all();
        // your additional operations before save here
        $date=Carbon::createFromFormat('d/m/Y',$request->date)->toDateString();
        $request->merge(['date' => $date]);
        //$request->date=$date;
        //return $request->all();

         $operation=DailyOperation::create($request->all());
         DailyOperation::findOrFail($operation->id)->locations()->attach($request->locations);
        return redirect()->back();

        //DailyOperation::
        //$redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        //return $redirect_location;
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
