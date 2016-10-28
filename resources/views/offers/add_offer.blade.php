@extends('layouts.app')

@section('content')
    <h1> {{trans('offers.offer_title')}} </h1>

    <div class="container">
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.title')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->title}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.service')}}</label>
            <div class="col-sm-6">
                {{$service->getTranslation(\Session::get('language'))->service}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.region')}}</label>
            <div class="col-sm-6">
                {{$region->getTranslation(\Session::get('language'))->region}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.content')}}</label>
            <div class="col-sm-6">
               {{$cm_ad->content}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.deadline')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->deadline}}
            </div>
        </div><br/><br/>
        <div class="form-group form-horizontal">
            <label class="col-sm-3 control-label">{{trans('ads.budget')}}</label>
            <div class="col-sm-6">
                {{$cm_ad->budget}}
            </div>
        </div>
    </div>
    @if($cm_ad->date_accepted)
        <div class="container">
            <h4> 
                {{trans('offers.offer_title')}}
                This add is already approved on {{$cm_ad->date_accepted}}. You cannot place offer. 
            </h4>
        </div>
    @else
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    {!! Form::open(array('url' => 'offer', 'method' => 'post', 'class' => 'form-horizontal')) !!}
<?php
    echo Form::hidden('cm_ad_id', $cm_ad->id, array('class' => 'form-control'));
    echo Form::hidden('ad_user_id', $cm_ad->created_by, array('class' => 'form-control'));

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('price', trans('offers.price'));
        echo Form::text('price', e(old('price')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1">';
        echo Form::label('comment', trans('offers.comment'));
        echo Form::textarea ('comment', e(old('comment')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo '<div class="row">';
    echo '<div class="form-group col-md-9 col-md-push-1" id="datetimepicker1">';
        echo Form::label('deadline', trans('offers.deadline'));
        echo Form::text('deadline', e(old('deadline')), array('class' => 'form-control'));
    echo '</div> </div>';

    echo Form::submit(trans('offers.btn_add'), array('class' => 'btn btn-primary pull-right'));
?>
    {!! Form::close() !!}
    @endif
    <?php
        echo link_to_route('route.ads_list', $title = trans('offers.btn_cancel'), $parameters = null, $attributes = array('class' =>"btn btn-default pull-right"));
    ?>
@endsection
