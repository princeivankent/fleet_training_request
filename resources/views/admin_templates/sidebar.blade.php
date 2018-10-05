<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ url('public/images/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>

        <div class="pull-left info">
            <p>Administrator</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <li id="dashboard_tab"><a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span>
        </a></li>
        <li id="dealer_tab"><a href="{{ route('dealers') }}">
            <i class="fa fa-link"></i> 
            <span>Dealers</span>
        </a></li>
        <li id="unit_model_tab"><a href="{{ route('unit_models') }}">
            <i class="fa fa-link"></i> 
            <span>Unit Models</span>
        </a></li>
        <li id="training_program_tab"><a href="{{ route('training_programs') }}">
            <i class="fa fa-link"></i> 
            <span>Training Programs</span>
        </a></li>
    </ul>
</section>