<?php
$admin = null;
if (session()->has('admin')) {
$admin = session()->get('admin');
}
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="border-bottom:1px solid #ddd;">

            <div class="pull-left image">
                @if ($admin != null && !empty($admin->image))
                    <img src="{{ asset('storage/' . $admin->image) }}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info" style="top:1px;">
                @if ($admin != null)
                    <h4>{{ explode(' ', trim($admin->name))[0] }}</h4>
                @endif
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>



        </div>
        <br />

        <ul class="sidebar-menu" data-widget="tree">

          
            <li class="treeview">
                <a to="/"><i class="fa fa-dashboard"></i> <span><router-link :to="{name:'dashboard'}">Dashboard</router-link></span> </a>
             </li>
           
            @if($admin->can('manage Order'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-first-order"></i> <span>Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>


                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'addOrder'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'order'}"><i class="fa fa-eye"></i>Manage</router-link>

                    </li>
                   

                </ul>
            </li>
            @endif

             @if($admin->can('manage wholessale'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>WholeSale</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'addWholeSale'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'WholeSaleOrder'}"><i class="fa fa-eye"></i>Manage</router-link>

                    </li>
                   

                </ul>
            </li>
            @endif

            {{-- @if($admin->can('manage Sale'))
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Office Sale</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                 </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'AddSale'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>
                     <li>
                        <router-link :to="{ name: 'AddSaleExchange'}"><i class="fa fa-exchange"></i>Exchange</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'officeSale'}"><i class="fa fa-eye"></i>Manage</router-link>
                         </li>
                         
                   </ul>
            </li>
            @endif --}}



            
            {{-- @if($admin->can('manage Sale'))
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Company Sale</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>


                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'AddCompanySale'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'compnaySale'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                  </ul>
            </li>
            @endif --}}

            {{-- @if($admin->can('manage purchase'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Product Purchase</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>


                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'addPurchase'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>

                    <li>
                        <router-link :to="{ name: 'purchase'}"><i class="fa fa-eye"></i>Manage</router-link>

                    </li>


                </ul>
            </li>
            @endif
               @if($admin->can('manage purchase'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Fabrics Purchase</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>


                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'AddPurchaseFabrics'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>

                    <li>
                        <router-link :to="{ name: 'ManagePurchaseFabrics'}"><i class="fa fa-eye"></i>Manage</router-link>

                    </li>


                </ul>
            </li>
            @endif --}}

             @if($admin->can('Manage accounts'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Accounts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'credit'}"><i class="fa fa-eye"></i> Credit</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'debit'}"><i class="fa fa-eye"></i>Debit</router-link>
                    </li>
                     <li>
                        <router-link :to="{ name: 'CreditDue'}"><i class="fa fa-eye"></i>Due</router-link>
                    </li>
                    
                </ul>
            </li>
            @endif

             @if($admin->can('Manage accounts'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Fund Transfer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'fondtransferAdd'}"><i class="fa fa-eye"></i>Add</router-link>
                    </li>
                     <li>
                        <router-link :to="{ name: 'fondtransfer'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                    
                </ul>
            </li>
            @endif
            
            @if($admin->can('manage product'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <router-link :to="{ name: 'productAdd'}"><i class="fa fa-plus"></i>Add</router-link>
                        <router-link :to="{ name: 'product'}"><i class="fa fa-eye"></i>Manage</router-link>

                    </li>
                </ul>
            </li>
            @endif
            @if($admin->can('manage category'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Category Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'category'}"><i class="fa fa-circle-o"></i> category</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'SubCategory'}"><i class="fa fa-circle-o"></i>sub category
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'subSubCategory'}"><i class="fa fa-circle-o"></i>sub sub category
                        </router-link>
                    </li>
                </ul>
            </li>
            @endif
            

             @if($admin->can('manage attribute'))
         <li class="treeview">
                <a href="#">
                    <i class="fa fa-deviantart"></i> <span>attribute & variant</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'attributeAdd'}"><i class="fa fa-plus"></i> Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'attribute'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'variant'}"><i class="fa fa-circle-o"></i>Variant</router-link>
                    </li>

                </ul>
        </li>
        @endif
          @if($admin->can('create and manage slider'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sliders"></i> <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'sliderAdd'}"><i class="fa fa-plus"></i>Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'slider'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                      <li>
                        <router-link :to="{ name: 'category_slider'}"><i class="fa fa-eye"></i>Category Slider</router-link>
                    </li>
                </ul>
            </li>
            @endif
       
           

             @if($admin->can('manage admin'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'adminAdd'}"><i class="fa fa-plus"></i> Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'admin'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                </ul>
            </li>
        @endif
           

            {{-- @if($admin->can('create and manage merchant'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>Merchant</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'add_merchant'}"><i class="fa fa-plus"></i> Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'merchant'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                </ul>
            </li>
            @endif --}}

            

              @if($admin->can('manage team'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle "></i> <span>Team</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                     <li>
                        <router-link :to="{ name: 'add_team_member'}"><i class="fa fa-plus"></i> Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'team_member'}"><i class="fa fa-eye"></i> Manage</router-link>
                    </li>
                 
                </ul>
            </li>
            @endif


            {{-- @if($admin->can('manage reseller'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Reseller</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                     <li>
                        <router-link :to="{ name: 'resellerAdd'}"><i class="fa fa-plus"></i> Add</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'resellerHome'}"><i class="fa fa-eye"></i>Manage</router-link>
                    </li>
                 
                </ul>
            </li>
            @endif
             @if($admin->can('manage reseller'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Reseller Payment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                     <li>
                        <router-link :to="{ name: 'UnpaidPayment'}"><i class="fa fa-plus"></i>Unpaid</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'paidPayment'}"><i class="fa fa-eye"></i>Paid</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'PaymentInvoice'}"><i class="fa fa-eye"></i>Invoice</router-link>
                    </li>
                    
                 
                </ul>
            </li>
            @endif --}}

                @if($admin->can('manage users'))
                <li class="treeview">
                    <router-link  :to="{ name: 'user'}"  > <i class="fa fa-user-circle"></i>Users</router-link>
                </li>
            @endif
            @if($admin->can('manage customers'))
             <li class="treeview">
                <router-link :to="{ name: 'customer'}"  > <i class="fa fa-user-circle"></i> Customers</router-link>
            </li>
            @endif

            @if($admin->can('manage reports'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'OrderReport'}"><i class="fa fa-eye"></i> Order Report</router-link>
                    </li>

                    <li>
                        <router-link :to="{ name: 'OfficeSaleReport'}"><i class="fa fa-eye"></i>Office Sale Report
                        </router-link>
                    </li>
                     <li>
                        <router-link :to="{ name:'OrderProfite'}"><i class="fa fa-eye"></i>Order Profit</router-link>

                    <li>
                     <li>
                        <router-link :to="{ name: 'SaleProfite'}"><i class="fa fa-eye"></i>Sale Profit
                        </router-link>
                    </li>
                    
                      <li>
                        <router-link :to="{ name: 'PurchaseReport'}"><i class="fa fa-eye"></i>Purchase Report
                        </router-link>
                    </li>
                    
                    <li>
                        <router-link :to="{ name: 'SupplierReport'}"><i class="fa fa-eye"></i>Supplier Report</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'AccountReport'}"><i class="fa fa-eye"></i>Account Report
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'productStcok'}"><i class="fa fa-eye"></i>Stock Report</router-link>

                    <li>
                   <li>
                        <router-link :to="{ name: 'ProfiteReport'}"><i class="fa fa-eye"></i>Profite Report</router-link>

                    <li>
                   
                        

                </ul>
            </li>

            @endif
            @if($admin->can('manage basic set up'))

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fire"></i> <span>Sale Campaign</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link :to="{ name: 'sale_campaign'}"><i class="fa fa-eye"></i>menage</router-link>
                    </li>
                </ul>
            </li>  

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Basic setup</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li> <router-link :to="{ name: 'account_purpose'}" > <i class="fa fa-list"></i> Account purpose </router-link> </li>
                        <li>
                            <router-link :to="{ name: 'city'}"><i class="fa fa-building"></i>City</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'sub_city'}"><i class="fa fa-building"></i>Sub City</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'courier'}"><i class="fa fa-eye"></i>Courier</router-link>
                            <router-link :to="{ name: 'company'}"><i class="fa fa-eye"></i>Company</router-link>
                            <router-link :to="{ name: 'selling_offer'}"><i class="fa fa-eye"></i>Selling Offer</router-link>

                            <router-link :to="{ name: 'comment'}"><i class="fa fa-eye"></i>Comment</router-link>
                            <router-link :to="{ name: 'offer'}"><i class="fa fa-eye"></i>Offer</router-link>
                        @if($admin->can('View Role'))
                        <router-link :to="{ name: 'role'}"><i class="fa fa-eye"></i>Role</router-link>
                        @endif


                        </li>
                        
                    </ul>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Setting</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <router-link :to="{ name: 'general_setting'}"><i class="fa fa-eye"></i>General Setting</router-link>
                        </li>

                        <li>
                            <router-link :to="{ name: 'footer_setting'}"><i class="fa fa-eye"></i>Footer Setting</router-link>
                        </li>

                        
                        <li>
                            <router-link :to="{ name: 'theme_setting'}"><i class="fa fa-tint "></i> Color Setting</router-link>
                        </li>
                     
                        <li>
                            <router-link :to="{ name: 'about_and_contact'}"><i class="fa fa-eye "></i> About And Contact Info. </router-link>
                        </li>

                        <li>
                            <router-link :to="{ name: 'order_shipment_return'}"><i class="fa fa-eye "></i> Oder Shipment and Return Info </router-link>
                        </li>

                    </ul>
                </li>  
            @endif
          
        </ul>
    </section>
</aside>
