@extends('layouts.master')
@section('css')
@stop

{{-- Models for statistics --}}
@inject('client','App\Models\Client')
@inject('restaurant','App\Models\Restaurant')
@inject('order','App\Models\Order')
@inject('city','App\Models\City')


{{-- browsr title --}}
@section('title','Sofra | Dashboard')
{{-- Page Content  title --}}
@section('page-header','Statistics')

@section('content')
<section class="content">

    <x-flash-success />
    <x-flash-error />
    <div class="row">
      <x-statistics-card :count="$order->count()" :category="'Total Orders'" :icon="'bag'" :bg="'blue'" :link="route('admin.orders.index')" />
      <x-statistics-card :count="$restaurant->count()" :category="'Subscribed Restaurants'" :icon="'home'" :bg="'green'" :link="route('admin.restaurants.index')"/>
      <x-statistics-card :count="$client->count()" :category="'Active Clients'" :icon="'person-add'" :bg="'red'" :link="route('admin.clients.index')"/>
      <x-statistics-card :count="$city->count()" :category="'Coverd Cities'" :icon="'map'" :bg="'orange'" :link="route('admin.cities.index')"/>
    </div>
  </section>
@endsection

@section('scripts')

@stop