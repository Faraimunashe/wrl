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
                            <a href="{{ route('student-chat', $chat->id) }}" class="list-group-item list-group-item-action border-0">
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
                                    {{-- <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40"> --}}
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    {{-- <strong>Sharon Lessman</strong>
                                    <div class="text-muted small"><em>Typing...</em></div> --}}
                                </div>
                                <form action="{{ route('student-new-chat') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select name="new_chat_id" class="form-control my-3" required>
                                                <option selected disabled>Select User</option>
                                                @foreach (\App\Models\User::all() as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-primary btn-lg mr-1 px-3" type="submit">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4">
                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
