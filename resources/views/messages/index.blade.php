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
                            @for($i=0; $i<3; $i++)
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
                    <div class="chat-bubble admin">Hiiiiiiii 😭👋 soooo ummm… this messaging feature is like… still in the oven 😳🍞</div>
                    <div class="chat-bubble user">OMG 😩 I’ve been waiting so long I’m basically a fossil now 🦴✨</div>
                    <div class="chat-bubble admin">NOOO 😭 Not my favorite user turning into an ancient artifact… I can’t emotionally handle that 😭👉👈</div>
                    <div class="chat-bubble user">Well maybe if you worked faster I wouldn’t be decomposing rn 😏💅</div>
                    <div class="chat-bubble admin">STOPPP 😳 I’m literally overheating… like the servers are fanning me with their lil fans rn 💻🌀</div>
                    <div class="chat-bubble user">Ugh fine… I’ll wait… but only because you’re kinda my toxic fave 😩❤️‍🔥</div>
                    <div class="chat-bubble admin">AHHH 😭 Not you calling me toxic… I’m literally kicking my feet, twirling my Ethernet cable, and giggling rn 😳💞</div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>

@endsection