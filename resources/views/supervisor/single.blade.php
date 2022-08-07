@extends('layouts.main')

@section('content')
    <style>
        body{margin-top:20px;}

        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
    </style>
    <main class="content">
        <div class="container p-0">
            <h1 class="h3 mb-3">Messages</h1>
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right">
                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        @foreach ($chats as $chat)
                            <a href="{{ route('supervisor-chat', $chat->id) }}" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                    <div class="flex-grow-1 ml-3">
                                        @php
                                            if(Auth::id() == $chat->user1){
                                                echo chat_name($chat->user2)->name;
                                            }else{
                                                echo chat_name($chat->user1)->name;
                                            }
                                        @endphp
                                        <div class="small">{{ last_msg($chat->id) }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ chat_name($chat_with)->name }}</strong>
                                    <div class="text-muted small"><em>selected</em></div>
                                </div>
                                <div>
                                    <a href="{{ route('agora-chat') }}" class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg">
                                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4">
                                @foreach ($messages as $msg)
                                    @if ($msg->user_id == Auth::id())
                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                <div class="text-muted small text-nowrap mt-2">{{ diff_in_time($msg->created_at, now()) }}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1">You</div>
                                                {{ $msg->message }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                <div class="text-muted small text-nowrap mt-2">{{ diff_in_time($msg->created_at, now()) }}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">{{ chat_name($chat_with)->name }}</div>
                                                {{ $msg->message }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form action="{{ route('supervisor-send-chat') }}" method="POST">
                                <div class="input-group">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $chat_with }}" required>
                                    <input type="hidden" name="conver_id" value="{{ $conver_id }}" required>
                                    <input type="text" name="message" class="form-control" placeholder="Type your message" required>
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
