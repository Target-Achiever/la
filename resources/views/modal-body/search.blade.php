<style>
</style>
<div class="box-header with-border" align="center">
    <h3 class="box-title" >Active providers</h3>
</div>
<!--Accordion wrapper-->
<div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

    @foreach ($provider_list as $key => $country)
    <!-- Accordion card -->
    @php $count = \DB::table('user_details')->join('users','users.id','=','user_details.user_id')
                -> where (function ($query){
                    $query  -> where( 'users.user_type', '=', 'prescriber' )
                            -> orWhere( 'users.user_type', '=', 'non_prescriber' );
                })
                ->where('users.administrator_approval','=',1)

                ->where('user_details.country','like',$country->country)
                ->count();
    @endphp
    <div class="card">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle"  data-toggle="collapse" data-parent="toggle" href="#collapseOne_{{$key}}">
                    <i class="fa fa-plus"></i>  {{$country->country }} ({{$count}})
                </a>
            </div>
            <div id="collapseOne_{{$key}}" class="accordion-body collapse ">
                <div class="accordion-inner">
                    @php $provider_city = \DB::table('user_details')->join('users','users.id','=','user_details.user_id')
                    -> where (function ($query){
                    $query  -> where( 'users.user_type', '=', 'prescriber' )
                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );
                    })
                    ->where('users.administrator_approval','=',1)
                    ->where('user_details.country','like',$country->country)
                        ->groupBy('user_details.city')
                        ->select('user_details.city')->get()
                    @endphp

                    @foreach($provider_city as $c_key => $city)
                             @php $provider_count = \DB::table('user_details')->join('users','users.id','=','user_details.user_id')
                                -> where (function ($query){
                                $query  -> where( 'users.user_type', '=', 'prescriber' )
                                -> orWhere( 'users.user_type', '=', 'non_prescriber' );
                                })
                                ->where('users.administrator_approval','=',1)
                                ->where('city','like',$city->city)->count() @endphp

                             <p style="margin-left: 30px"> {{ $city->city }} ({{$provider_count}}) </p>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- Accordion card -->
    @endforeach






</div>



<script>jQuery('.accordion-toggle').click(function(){

        var has = jQuery(this);
        if(has.hasClass('collapsed')){
            jQuery(this).find('i').removeClass('fa-minus');
            jQuery(this).find('i').addClass('fa-plus');
        }
        else{
            jQuery(this).find('i').removeClass('fa-plus');
            jQuery(this).find('i').addClass('fa-minus');
        }
    })</script>