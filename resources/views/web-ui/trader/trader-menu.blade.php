<div class="skills-area">
    <h5>Trader Links</h5>
    <div class="quick-links">
        <ul>
            <li><a href="{{ route('traderjobsbystatus','completed') }}">Completed Jobs{{ ($job_count['completed'] > 0)?" (".$job_count['completed'].")":"" }}</a></li>
            <li><a href="{{ route('traderjobsquoterequests') }}">Job Quote Requests{{ ($job_quote_count > 0)?" (".$job_quote_count.")":"" }}</a></li>
            <li><a href="{{ route('traderjobsbystatus','accepted') }}">Accepted Jobs {{ ($job_count['accepted'] > 0)?" (".$job_count['accepted'].")":"" }}</a></li>
            <li><a href="{{ route('traderjobsbystatus','rejected') }}">Rejected Jobs {{ ($job_count['rejected'] > 0)?" (".$job_count['rejected'].")":"" }}</a></li>
            <li><a href="{{ route('traderjobsbystatus','ongoing') }}">Ongoing Jobs {{ ($job_count['ongoing'] > 0)?" (".$job_count['ongoing'].")":"" }}</a></li>
            <li><a href="{{ route('trader-appointments') }}">Appointments</a></li>
            <li><a href="{{ route('trader-bazaar') }}">Bazaar</a></li>
            <!-- <li><a href="#">Visits</a></li> -->
            <li><a href="{{ route('trader.receipts.index') }}">Receipts</a></li>
            <li><a href="{{ route('trader.messages.index') }}">Messages</a></li>
            <li><a href="{{ route('profileinsights') }}">Profile Insights</a></li>
            <li><a href="{{ route('customers-blocked') }}">Customers Blocked</a></li>
            <!-- <li><a href="#">Total Interact</a></li>
            <li><a href="#">Total Search Appearance</a></li> -->
        </ul>
    </div>
</div>