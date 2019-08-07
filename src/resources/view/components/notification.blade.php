@php
    use Illuminate\Support\Facades\Auth;$user = Auth::user();
@endphp
<ul class="notification-list no-margin hidden-sm hidden-xs b-grey b-l b-r no-style p-l-30 p-r-20">
    <li class="p-r-15 inline">
        <div class="dropdown">
            <a href="javascript:" id="notification-center" class="icon-set"
               data-toggle="dropdown">
                <i class="fas fa-globe-africa fa-lg"></i>
                @if($user->unreadNotifications->count() >= 1)
                    <span class="bubble"></span>
                @endif
            </a>
            <div class="dropdown-menu notification-toggle" role="menu"
                 aria-labelledby="notification-center">
                <div class="notification-panel">
                    <div class="notification-body scrollable">
                        @foreach($user->notifications->take(5) as $notification)
                            @if(is_null($notification->read_at))
                                @php
                                    $notification_class = 'unread';
                                    $read = false;
                                @endphp
                            @else
                                @php
                                    $notification_class = 'read';
                                    $read = true;
                                @endphp
                            @endif
                            <div class="notification-item {!! $notification_class !!} clearfix">
                                <div class="heading open">
                                    <a href="#" class="text-complete pull-left">
                                        <i class="pg-map fs-16 m-r-10"></i>
                                        <a href="{!! admin_url($notification->data['link']) !!}?notification={!! $notification->id  !!}">
											<span class="bold">
												{!! $notification->data['title'] !!}
											</span>
                                        </a>
                                        <span class="fs-12 m-l-10">
											{{-- NOME --}}
										</span>
                                    </a>
                                    <div class="pull-right">
                                        <div class="thumbnail-wrapper d16 circular inline m-t-15 m-r-10 toggle-more-details">
                                            <div><i class="fa fa-angle-left"></i>
                                            </div>
                                        </div>
                                        <span class=" time">
								{!! $notification->created_at !!}
							</span>
                                    </div>
                                    <div class="more-details">
                                        <div class="more-details-inner">
                                            <div class="media">
                                                <img class="align-self-center mr-3"
                                                     width="40px"
                                                     src="{{ asset($notification->data['img']) }}">
                                                <div class="media-body">
                                                    <p>
                                                        {!! $notification->data['message'] !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($read)
                                    <div class="option">
                                        <a href="#" class="mark"></a>
                                    </div>
                                @else
                                    <div class="option" data-toggle="tooltip" data-placement="left"
                                         title="Segna come letto">
                                        <a href="#" class="mark"></a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="notification-footer text-center">
                        <a href="{{ admin_url('/notifications') }}" class="">Mostra tutte</a>
                        <a data-toggle="refresh" class="portlet-refresh text-black pull-right"
                           href="#">
                            <i class="pg-refresh_new"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
<!-- END NOTIFICATIONS LIST -->
<span class="topbar-separator"></span>
<a href="#" class="search-link" data-toggle="search">
    <i class="fas fa-search" style="vertical-align: text-bottom;"></i>
    Scrivi qualcosa per iniziare la <span class="bold">ricerca</span>
</a>