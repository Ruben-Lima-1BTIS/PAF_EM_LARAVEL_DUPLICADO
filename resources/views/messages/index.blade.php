@extends('layouts.auth')
@section('content')

<div class="messages-page">
<div class="max-w-6xl mx-auto p-6 space-y-8">

    <div class="page-header fade-up">
        <h2>Messages</h2>
        <p>Manage your internship communications</p>
    </div>

    <div class="grid gap-6">

        <div class="lg:col-span-1 card fade-up">
            <div class="card-body">
                <div class="stat-card-messages">
                    <div class="stat-icon-wrap-messages">📬</div>
                    <div>
                        <p class="stat-label-messages">Total Messages</p>
                        <p class="stat-value-messages">—</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 card fade-up">
            <div class="card-body">
                <p class="section-label">Inbox</p>
                <h3 class="card-title" style="margin-bottom:1.25rem;">Coming Soon</h3>

                <div class="overflow-x-auto">
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0; $i<5; $i++)
                            <tr>
                                <td>—</td>
                                <td>Feature in progress</td>
                                <td><span class="badge-placeholder">Pending</span></td>
                                <td>—</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="chat-container mt-6">
                    <div class="chat-bubble admin">Hi! 👋 This messaging feature will be available soon.</div>
                    <div class="chat-bubble user">Can’t wait to use it!</div>
                    <div class="chat-bubble admin">We’re working hard to get it ready for you.</div>
                    <div class="chat-bubble user">Alright, I’ll be patient 😏</div>
                    <div class="chat-bubble admin">Thanks for understanding! 🚀</div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>

@endsection