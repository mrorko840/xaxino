<?php $user = Auth::user(); ?>


<!-- menu main -->
<div class="main-menu">
    <div class="row mb-4 no-gutters">
        <div class="col-auto"><button class="btn btn-link btn-40 btn-close text-white"><span
                    class="material-icons">chevron_left</span></button></div>
        <div class="col-auto">
            <div class="avatar avatar-40 rounded-circle position-relative">
                <figure class="background">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="LOGO">
                </figure>
            </div>
        </div>
        <div class="col pl-3 text-left align-self-center">
            <h6 class="mb-1">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h6>
            <p class="small text-default-secondary">{{ Auth::user()->username }}</p>
        </div>
    </div>
    <div class="menu-container">
        <div class="row mb-4">
            <div class="col">
                <h4 class="mb-1 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($widget['total_balance']) }}</h4>
                <p class="text-default-secondary">My Balance</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('user.deposit.index') }}" class="btn btn-default btn-40 rounded-circle"><i
                        class="material-icons">add</i></a>
            </div>
        </div>

        <ul class="nav nav-pills flex-column ">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user.home') }}">
                    <div>
                        <span class="material-icons icon">account_balance</span>
                        Home
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.analytics') }}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Analytics
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.referrals') }}">
                    <div>
                        <span class="material-icons icon">person_add_alt_1</span>
                        Refer Friends
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.deposit.index') }}">
                    <div>
                        <span class="material-icons icon">credit_card</span>
                        Add Fund
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.withdraw') }}">
                    <div>
                        <span class="material-icons icon">shopping_bag</span>
                        Withdraw Fund
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile.setting') }}">
                    <div>
                        <span class="material-icons icon">manage_accounts</span>
                        Profile Settings
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.transactions') }}">
                    <div>
                        <span class="material-icons icon">layers</span>
                        Transactions
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.open') }}">
                    <div>
                        <span class="material-icons icon">support_agent</span>
                        Contact Admin
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
        </ul>
        <div class="text-center">
            <a href="{{ route('user.logout') }}" class="btn btn-outline-danger text-white rounded my-3 mx-auto">Sign out</a>
        </div>
    </div>
</div>
<div class="backdrop"></div>
