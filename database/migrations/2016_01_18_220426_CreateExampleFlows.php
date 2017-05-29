<?php


use Illuminate\Database\Migrations\Migration;
use Ixudra\Wizard\Repositories\Eloquent\EloquentFlowRepository;

class CreateExampleFlows extends Migration {

    public function up()
    {
        $config = array(
            'handler'                       => 'App\Flows\ExampleFlow\FlowHandler',
            'steps'                         => array(
                'first-step'                    => array(
                    'handler'                       => 'App\Flows\ExampleFlow\Steps\FirstStep'
                ),
                'second-step'                   => array(
                    'handler'                       => 'App\Flows\ExampleFlow\Steps\SecondStep'
                ),
            ),
        );

        DB::table('flows')->insert(
            array(
                'name'      => 'example-flow',
                'config'    => json_encode( $config )
            )
        );
    }

    public function down()
    {
        $flowRepository = App::make( EloquentFlowRepository::class );
        $flow = $flowRepository->findByName( 'example-flow' );
        if( !is_null($flow) ) {
            $flow->delete();
        }
    }

}
