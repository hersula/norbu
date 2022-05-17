@extends('layouts.member')
@section('contents') 
<div class="container mt-3 ">
  <div class="row " >
      <div class="col-md-12">
        <div class="card" style="background:hsl(0, 0%, 100%)">
            <div class="card-header">
                <h2 class="font-monospace"  style="color: rgb(23, 238, 209)"><i class="fas fa-diagnoses"></i> Riwayat Transaksi</h2>       
            </div>
          
            <div class="card-body fs-6">             
                    <div class="row mt-4 ">
                        <table class="table table-bordered text-center fs-6 ">
                            <thead>
                              <tr>
                                <th scope="col" style="background: rgb(23, 238, 209);">Invoice</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Tgl Tindakan</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Lokasi </th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Status</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                             <tr>
                                 <td>1</td>
                                 <td>Aso</td>
                                 <td>Pluit</td>
                                 
                                 <td>278888</td>
                                 <td><button class="btn btn-sm " type="button" id="btnDelete">Delete</button></td>
                             </tr>                    
                            
                             <tr>
                                 <td>1</td>
                                 <td>Aso</td>
                                 <td>Pluit</td>
                                 
                                 <td>278888</td>
                                 <td><button class="btn btn-sm " type="button" id="btnDelete">Delete</button></td>
                             </tr>                    
                            
                             <tr>
                                 <td>1</td>
                                 <td>Aso</td>
                                 <td>Pluit</td>
                                 
                                 <td>278888</td>
                                 <td><button class="btn btn-sm " type="button" id="btnDelete">Delete</button></td>
                             </tr>                                               
                            </tbody>
                          </table>
                        
                    </div>
                  
                </div>      
            </div>     
        </div>
    </div>
    </div>
    
     
   

    @endsection