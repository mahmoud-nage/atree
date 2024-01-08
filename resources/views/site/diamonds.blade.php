@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
      $dir = 'rtl';
    } else {
      $dir = 'ltr';
    }
@endphp

@extends('site.layouts.master')
@section('page_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3">

        <!-- Main content -->
        <section class="content">
            <div class="card-body">

                <div class="container">


                    <!-- Diamond Header -->
                    <div class="diamond-header">
                        <div class="diamond-header-left">
                            <div class="font-weight-bold"> <span class="diamond-title">Diamonds </span> Program</div>

                            <div class="diamond-progress-header">
                                <div> 8765 </div>
                                <div> Diamond </div>
                            </div>

                            <div class="diamond-progress-header">
                                <div> 87.65 </div>
                                <div> SAR </div>
                            </div>

                        </div>

                        <div class="diamond-header-right">
                            <div class="mb-4">
                                Earn More Every Day By stilling Be Amazing Designer
                            </div>
                            <div class="diamond-progress-header">
                                <div class="diamond-title"> Diamonds </div>
                                <div class="diamond-total">8765</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87.65%">
                                </div>
                            </div>
                            <div>
                                Complete 10000 Diamond To enable Using
                            </div>

                        </div>

                    </div>

                    <div class="font-weight-bold mb-3 text-lg">
                        How Diamond Program Work ?
                    </div>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard
                        dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                        book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
                        unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                        recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Lorem Ipsum is simply
                        dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since
                        the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                        not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                        desktop publishing software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is simply dummy text of
                        the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in
                        the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                        software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
                        Aldus PageMaker including versions of Lorem Ipsum
                    </p>


                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Invoice Modal -->
    <div class="modal fade" id="invoice-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="invoice-top">
                                <div>
                                    <img src="images/large-logo.png" />
                                </div>

                                <div>
                                    <img src="images/QR-code.png" />
                                </div>
                            </div>

                            <!-- </div> -->

                        </div>

                        <div class="row invoice-info">

                            <div class="col-sm-4 invoice-col">
                                <b class="mr-2">Invoice Number:</b> #007612<br>
                                <b class="mr-2">Order ID:</b> 4F3S8J<br>
                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>
                                <b class="mr-2">Account:</b> 968-34567
                            </div>

                            <div class="col-sm-4 invoice-col">
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b class="mr-2">Invoice</b> #007612<br>
                                <b class="mr-2">Order ID:</b> 4F3S8J<br>
                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>
                                <b class="mr-2">Account:</b> 968-34567
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr class="bg-light font-weight-bold">
                                        <th>Product Name</th>
                                        <th>Quantaity</th>
                                        <th>Size</th>
                                        <th>Colors</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>Red</td>
                                        <td>$64.50</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <p>Need for Speed IV</p>
                                            <p>Need for Speed IV</p>
                                        </td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>

                                    <tr class="bg-light font-weight-bold">
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th>Colors</th>
                                        <th>Price</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>Monsters DVD</td>
                                        <td>735-845-642</td>
                                        <td>Terry Richardson</td>
                                        <td>$10.70</td>
                                    </tr>


                                    <tr class="bg-light font-weight-bold">
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th></th>
                                        <th>Total Price</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="totalPrice">900 SAR</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save As PDF</button>
                    <button type="button" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
@endsection
