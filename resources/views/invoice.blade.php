@extends('layouts/default') {{-- Page title --}} @section('title') Invoice @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/invoice.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Invoice</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Invoice
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
                        <i class="fa fa-fw ti-credit-card"></i> Invoice
                    </h3>
        <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-12 col-xs-12 invoice_bg">
                    <h4><img src="img/logoblue.png" alt="clear"/></h4>
                    <h4><strong>Billing Details:</strong></h4>
                    <address>
                        Lewis Doe
                        <br/> 6889 Lunette Street
                        <br/> Melbourne,Austria
                        <br/> <strong>Phone:</strong>12-345-678
                        <br/> <strong>Mail Id:</strong> Adelle_Champlin@yahoo.com
                    </address>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 invoice_bg text-right">
                    <div class="pull-right">
                        <h4><strong>#678956 / 25 Sep 2016</strong></h4>
                        <h4><strong>Invoice Info:</strong></h4>
                        <address>
                            Tom Percy
                            <br/> 3946 Penn Street
                            <br/> Ohio,USA
                            <br/> <strong>Phone:</strong> 32-666-756
                            <br/> <strong>Mail Id:</strong> Lucy_Maggio16@yahoo.com
                        </address>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed" id="customtable">
                        <thead>
                            <tr class="bg-primary">
                                <th>
                                    <strong>Item Name</strong>
                                </th>
                                <th>
                                    <strong>Unit Cost</strong>
                                </th>
                                <th class="text-center">
                                    <strong>
                                                Quantity
                                            </strong>
                                </th>
                                <th></th>
                                <th class="text-right">
                                    <strong>Total</strong>
                                </th>
                                <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td contenteditable>
                                    Samsung Galaxy Grand
                                </td>
                                <td contenteditable>$700</td>
                                <td class="text-center" contenteditable>1</td>
                                <td></td>
                                <td class="text-right" contenteditable>$700</td>
                                <td class="text-center row_delete"><i class="fa fa-fw ti-close"></i></td>
                            </tr>
                            <tr>
                                <td contenteditable>
                                    Samsung Galaxy Core
                                </td>
                                <td contenteditable>$1110</td>
                                <td class="text-center" contenteditable>1</td>
                                <td></td>
                                <td class="text-right" contenteditable>$1110</td>
                                <td class="text-center row_delete"><i class="fa fa-fw ti-close"></i></td>
                            </tr>
                            <tr>
                                <td contenteditable>
                                    Screen Protector
                                </td>
                                <td contenteditable>$7</td>
                                <td class="text-center" contenteditable>4</td>
                                <td></td>
                                <td class="text-right" contenteditable>$28</td>
                                <td class="text-center row_delete"><i class="fa fa-fw ti-close"></i></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="highrow"></td>
                                <td class="highrow"></td>
                                <td class="highrow text-center"></td>
                                <td class="highrow text-right">
                                    <strong>
                                                Sub Total: &nbsp;
                                            </strong>
                                </td>
                                <td class="highrow text-right">
                                    <strong contenteditable>$1838</strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="emptyrow"></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-center"></td>
                                <td class="emptyrow text-right">
                                    <strong>
                                                Vat: &nbsp;
                                            </strong>
                                </td>
                                <td class="highrow text-right">
                                    <strong contenteditable>$20</strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="emptyrow">
                                    <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                </td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-center"></td>
                                <td class="emptyrow text-right">
                                    <strong>
                                                Total: &nbsp;
                                            </strong>
                                </td>
                                <td class="highrow text-right">
                                    <strong contenteditable>$1858</strong>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h4><Strong>Terms and conditions:</Strong></h4>
                <ul class="terms_conditions">
                    <li>An invoice must accompany products returned for warantty</li>
                    <li>Balance due within 10 days of invoice date,1.5% interest/month thereafter.</li>
                    <li>All goods returned for replacement/credit must be saleable condition with original packaging.
                    </li>
                </ul>
            </div>
        </div>
        <div class="btn-section">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <span class="pull-right">
                                            <button type="button"
                                                    class="btn btn-responsive button-alignment btn-success"
                                                    data-toggle="button">
                                                <i class="fa fa-fw ti-money"></i> Pay Now
                                            </button>
                                             <button type="button"
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;" onclick="javascript:window.print();">
                                                    <i class="fa fa-fw ti-printer"></i>
                                                Print
                                            </span>
                </button>
                </span>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('js/custom_js/invoice.js')}}"></script>@stop
