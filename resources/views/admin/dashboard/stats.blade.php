<div class="row">
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Sales">Total Users</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\User::count() }} </h3>
               
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Total Products">Published Jokes</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\Jokes::where('status',1)->count() }}</h3>
             
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                <i class="mdi mdi-account-group-outline widget-icon"></i>
                </div>
                <h5 class="text-dark fw-normal mt-0" title="Approved Suppliers">Request Publishing</h5>
                <h3 class="mt-2 mb-2">{{ \App\Models\Jokes::where('status',0)->count() }}</h3>
               
            </div>
        </div>
    </div> <!-- end col-->
</div>
<style>
    .widget-icon {
    display: block!important;
}
    </style>
