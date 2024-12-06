@extends('templates.SuperAdmin.admin_header')
@section('content')

<br/>
<center><h3>Abandoned Checkouts in the last 30 days  </h3></center>
    <div class="container-fluid">
        <div class="row">
            
             <div class="col-md-4">
              Columns
               <div class="dropdown">
              
  <button style="border: 1px solid #dee2e6;width:100%;" class="btn btn-default dropdown-toggle" type="button" 
          id="dropdownMenu1" data-toggle="dropdown" 
          aria-haspopup="true" aria-expanded="true">
     Select Columns
  </button>
  
  <ul class="dropdown-menu checkbox-menu" aria-labelledby="dropdownMenu1">
     
  <p><b>&nbsp;&nbsp;Orders</b><i class="fa fa-plus pull-right column_title_add"></i></p>
  <div class="container add_columns_div" style="display:none;">
       
                        Manage/Add Columns
                    <br/>
                  <div class="field_wrapper">
    <div>
       <input type="text" name="column_name[]"  value=""/>
        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a><br/>
        
    </div>
   
</div><br/> 
 <button type="submit" class="btn btn-sm btn-danger btn_add_columns">Add Columns</button>
          
  </div>
    <li>
      
        <input type="checkbox" name="mycolumn[]" value="Order">Order
      
    </li>
    
    <li>
      
        <input type="checkbox" name="mycolumn[]" value="Billing Address">Billing Address
    
    </li>
    
    <li>
      <label>
        <input type="checkbox" name="mycolumn[]" value="POS Location">POS Location
      </label>
    </li>
     <li>
     
        <input type="checkbox" name="mycolumn[]" value="Product">Product
    </li>
     <li>
     
        <input type="checkbox" name="mycolumn[]" value="Shipping Address">Shipping Address
    
    </li>
     <li>
    
        <input type="checkbox" name="mycolumn[]" value="Staff Member">Staff Member

     
    </li>
    
  </ul>
</div>
           </div>
                
            
           
             <div class="col-md-4">
               Sort By 
               <select name="sort" class="form-control">
               <option value="none">Select Option</option>
               <option value="none">Today</option> 
               <option value="none">Yesterday</option> 
               </select>
              
           </div>
          
               <div class="col-md-4">
               Actions<br/>
                 <button class="btn btn-sm btn-danger">Print</button>
                    <button class="btn btn-sm btn-danger">Import</button>
                     <button class="btn btn-sm btn-danger">Export</button>
                </div>
               
        </div>
       
     
        <br/>

   
  <div class="row">
      <div class="col-md-6">
           <input class="form-control" id="myInput" type="text" placeholder="Search..">
      </div>
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table" id="table1">
          <thead>
            <tr>
                  <th style="font-weight:500;">No</th>
        <th style="font-weight:500;">Date</th>
         <th style="font-weight:500;">Name</th>
        <th style="font-weight:500;">Mobile Number</th>
       <th style="font-weight:500;">Email</th>
        <th style="font-weight:500;">Age</th>
        <th style="font-weight:500;">Gender</th>
         <th style="font-weight:500;">Country</th>
         <th style="font-weight:500;">City</th>
         <th style="font-weight:500;">Area</th>
         <th style="font-weight:500;">Location</th>
         <th style="font-weight:500;">Address</th>
        
            </tr>
          </thead>
          <tbody id="myTable">
             <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                     <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                    <tr>
                                    <td>1</td> 
                                    <td>13,May,2022</td>
                                    <td>Test</td> 
                                    <td>90000000000</td> 
                                    <td>Test@gmail.com</td> 
                                    <td>20</td>
                                    <td>Female</td>
                                    <td>India</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                    <td>Pune</td>
                                  </tr>
                                  
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-12">
    
        <center><h3>Line Chart</h3></center><br/>
   
    <canvas id="myChart" style="width:100%;max-width:auto;"></canvas>
</div>
    
  </div>
</div>


@endsection