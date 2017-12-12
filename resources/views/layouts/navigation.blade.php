@php
    # Define a PHP array of links and their labels
    # This amount of PHP code in a view is okay because it's
    # display specific. By putting it in the view, I'm not making it
    # necessary to look in a logic file in order to edit link labels
    $jobsSubNav = [
        'job/create' => 'Create Job',
        'job' => 'Jobs List',
    ];
    $applicantsSubNav = [
        'applicant/create' => 'New Applicant',
        'applicant' => 'List Applicants',
    ];
    $adminSubNav = [
        'category' => 'Job Categories',
        'skills' => 'Skills',
    ];
@endphp

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Careers Portal</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Jobs
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    @foreach($jobsSubNav as $link1 => $label1)
                    <li><a href='/{{ $link1 }}'>{{ $label1 }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Applicants
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                      @foreach($applicantsSubNav as $link2 => $label2)
                      <li><a href='/{{ $link2 }}'>{{ $label2 }}</a></li>
                      @endforeach
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                      @foreach($adminSubNav as $link3 => $label3)
                      <li><a href='/{{ $link3 }}'>{{ $label3 }}</a></li>
                      @endforeach
                </ul>
            </li>
        </ul>
    </div>
</nav>
