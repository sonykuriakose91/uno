<div class="quick-links">
    <ul>
        <li><a href="{{ route('post-job') }}">Post Job</a></li>
        <li><a href="{{ route('jobsbystatus','draft') }}">Draft Job {{ ($job_count['draft'] > 0)?" (".$job_count['draft'].")":"" }}</a></li>
        <!-- <li><a href="">Offline Jobs</a></li> -->
        <li><a href="{{ route('jobsbystatus','published') }}">Live/ Posted Jobs {{ ($job_count['published'] > 0)?" (".$job_count['published'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','unpublished') }}">Unpublished Jobs {{ ($job_count['unpublished'] > 0)?" (".$job_count['unpublished'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','seekquote') }}">Seeking Quote {{ ($job_count['seekquote'] > 0)?" (".$job_count['seekquote'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','completed') }}">Completed {{ ($job_count['completed'] > 0)?" (".$job_count['completed'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','accepted') }}">Accepted Jobs {{ ($job_count['accepted'] > 0)?" (".$job_count['accepted'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','rejected') }}">Rejected Jobs {{ ($job_count['rejected'] > 0)?" (".$job_count['rejected'].")":"" }}</a></li>
        <li><a href="{{ route('jobsbystatus','ongoing') }}">Ongoing Jobs {{ ($job_count['ongoing'] > 0)?" (".$job_count['ongoing'].")":"" }}</a></li>
        <li><a href="{{ route('clarification-requests') }}">Clarification Request</a></li>
        <li><a href="{{ route('customer.receipts.index') }}">Receipts</a></li>
        <li><a href="{{ route('customer-appointments') }}">Appointments</a></li>
        <li><a href="{{ route('customer.messages.index') }}">Messages</a></li>
        <li><a href="#" data-toggle="modal" data-target="#sellatbazaar">Sell at Bazaar</a></li>
        <li><a href="{{ route('customer-bazaar') }}">Bazaar</a></li>
        <li><a href="{{ route('customer-wishlist-products') }}">Bazaar Wish List</a></li>
        <li><a href="{{ route('blocked-traders') }}">Blocked Traders</a></li>
    </ul>
</div>