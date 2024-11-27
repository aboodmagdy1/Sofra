@extends('layouts.master')
@section('title','Restaurant Details')
@section('page-header','Restaurant Details')
@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-utensils"></i> {{$record->name}}
                  <small class="float-right">Register At : {{$record->created_at->toDateString()}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info d-flex justify-between">
              <div class="col-sm-4 invoice-col ">
                
                <address>
                  <strong>Contact Info : </strong><br>
                 Email :  {{$record->email}}<br>
                 Phone :  {{$record->phone}}<br>
                 Contact Num:  {{$record->contact_num}}<br>
                 Whats Num:  {{$record->watts_num}}<br>
                 Address : {{$record->district->name}}/ {{$record->district->city->name}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>business Info :</strong><br>
                  Total Meals : {{$record->meals()->count()}}<br>
                  Min Order Price : {{$record->min_order_price}}<br>
                  Delivery Price : {{$record->delivery_price}}<br>
                  Average Rate : {{$record->avg_rate}}<br>
                </address>
              </div>

              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Category :</strong><br>
                   @if ($record->categories->count()>0)
                    @foreach ($record->categories as $category)
                    <span class="badge badge-primary">{{$category->name}}</span>
                    @endforeach
                    @else
                    <span class="badge badge-danger">No Category</span>
                       
                   @endif
                </address>
              </div>

            </div>

            <div class="row">

              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Dues</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Orders Count : </th>
                      <td>{{$record->orders()->count()}}</td>
                    </tr>
                    <tr>
                      <th>Total Commission :</th>
                      <td>{{$record->orders()->sum('commission_price')}}</td>
                    </tr>
                    <tr>
                      <th>Payed :</th>
                      <td>{{$record->commissions()->sum('amount')}}</td>
                    </tr>
                    <tr>
                      <th>Due :</th>
                      <td>{{{$record->orders()->sum('commission_price') - $record->commissions()->sum('amount')}}} </td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection