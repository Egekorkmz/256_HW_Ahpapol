<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>Social network wall - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .text-white {
            color: rgba(255, 255, 255, .87);
        }

        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xs {
            padding: 8px;
            width: auto
        }

        @media only screen and (min-width:480px) {

            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xs {
                padding: 16px
            }
        }

        @media only screen and (min-width:992px) {

            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xs {
                padding: 24px
            }
        }

        .container-lg {
            max-width: 1500px
        }

        .container-md {
            max-width: 1200px
        }

        .container-sm {
            max-width: 1000px
        }

        .container-xs {
            max-width: 500px
        }

        @media only screen and (max-width:1199px) {

            input[type=text],
            input[type=email],
            input[type=search],
            input[type=password] {
                -webkit-appearance: none
            }

            .container-unwrap {
                padding: 0
            }

            .container-unwrap>.row {
                margin: 0
            }

            .container-unwrap>.row>[class*=col-] {
                padding-left: 0;
                padding-right: 0
            }

            .container-unwrap .card {
                margin-bottom: 0
                
            }
        }

        .container-overlap {
            position: relative;
            padding: 32px 16px 64px;
            display: flex;
        }

        .container-overlap+.container-fluid,
        .container-overlap+.container-lg,
        .container-overlap+.container-md,
        .container-overlap+.container-sm,
        .container-overlap+.container-xs {
            padding-top: 0;
            margin-top: -32px
        }

        .container-overlap+.container-fluid .push-down,
        .container-overlap+.container-lg .push-down,
        .container-overlap+.container-md .push-down,
        .container-overlap+.container-sm .push-down,
        .container-overlap+.container-xs .push-down {
            display: block;
            height: 48px
        }

        .bg-indigo-500 {
            background-color: #9600bf;
        }

        .container-overlap {
            position: relative;
            padding: 32px 16px 64px;
        }

        .fw {
            width: 100% !important;
        }

        .thumb64 {
            width: 64px !important;
            height: 64px !important;
        }

        .thumb48 {
            width: 48px !important;
            height: 48px !important;
        }

        .card {
            position: relative;
            border-radius: 3px;
            background-color: #fff;
            color: #4F5256;
            border: 1px solid rgba(0, 0, 0, .12);
            margin-top: 32px;

        }

        @media only screen and (min-width:480px) {
            .card {
                margin-bottom: 16px
            }
        }

        @media only screen and (min-width:992px) {
            .card {
                margin-bottom: 24px
            }
        }

        .card .card-heading {
            padding: 16px;
            margin: 0
        }

        .card .card-heading>.card-title {
            margin: 0;
            font-size: 18px
        }

        .card .card-heading>.card-icon {
            float: right;
            color: rgba(255, 255, 255, .87);
            font-size: 20px
        }

        .card .card-heading>small {
            color: rgba(162, 162, 162, .92);
            letter-spacing: .01em
        }

        .card .card-body {
            position: relative;
            padding: 16px
        }

        .card .card-footer {
            padding: 16px;
            border-top: 1px solid rgba(162, 162, 162, .12)
        }

        .card .card-item {
            position: relative;
            display: block;
            min-height: 120px
        }

        .card .card-item>.card-item-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, .35);
            margin: 0;
            color: #fff;
            padding: 8px
        }

        .card .card-item>.card-item-text a {
            color: inherit
        }

        .card .card-item>.card-item-image {
            display: block;
            width: 100%;
            height: 190px;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover
        }

        .card .card-item.card-media {
            min-height: 280px;
            background-repeat: repeat;
            background-position: 50% 50%;
            background-attachment: scroll;
            background-origin: padding-box
        }

        .card .card-item.card-media .card-media-quote {
            padding: 16px;
            font-size: 35px
        }

        @media only screen and (min-width:768px) {
            .card .card-item.card-media .card-media-quote {
                font-size: 45px
            }
        }

        .card .card-item.card-media .card-media-quote>a {
            color: inherit;
            text-decoration: none
        }

        .card .card-item.card-media .card-media-quote:before {
            content: '“';
            display: block;
            font-size: 2em;
            line-height: 1;
            margin-top: .25em
        }

        .btn-label:after,
        .c-radio span:before,
        .container-overlap:before,
        .note-area.note-area-margin:after,
        .switch span:after {
            content: ""
        }

        .card.card-transparent {
            background-color: transparent;
            border: 0;
            -webkit-box-shadow: 0 0 0 #000;
            box-shadow: 0 0 0 #000
        }

        .card .card-offset {
            position: relative;
            padding-bottom: 36px;
            z-index: 10
        }

        .card .card-offset>.card-offset-item {
            position: absolute;
            top: -24px;
            left: 15px;
            right: 15px
        }

        .card .card-toolbar {
            position: relative;
            width: 100%;
            min-height: 64px;
            font-size: 18px;
            line-height: 64px;
            padding-left: 22px;
            z-index: 2
        }

        .card .card-subheader {
            padding: 16px 0 16px 16px;
            line-height: .75em;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: .01em;
            color: rgba(0, 0, 0, .54)
        }

        .card .card-subheader+.mda-list>.mda-list-item:first-child>.mda-list-item-text,
        .card>.btn {
            padding-top: 16px
        }

        .card .card-subheader+.mda-list>.mda-list-item:first-child>.mda-list-item-icon,
        .card .card-subheader+.mda-list>.mda-list-item:first-child>.mda-list-item-img,
        .card .card-subheader+.mda-list>.mda-list-item:first-child>.mda-list-item-initial {
            margin-top: 10px
        }

        .card .card-divider {
            display: block;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid rgba(0, 0, 0, .12)
        }

        .card .card-divider+.card-offset {
            margin-top: -10px
        }

        .card>.ui-datepicker,
        .card>.ui-datepicker-responsive>.ui-datepicker {
            width: 100%;
            -webkit-box-shadow: 0 0 0 #000;
            box-shadow: 0 0 0 #000;
            margin: 0
        }

        .card .editable-wrap,
        .card>.ui-datepicker-responsive>.ui-datepicker>table,
        .card>.ui-datepicker>table {
            width: 100%
        }

        .card>.list-group>.list-group-item {
            border-left: 0;
            border-right: 0
        }

        .card>.list-group>.list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .card>.list-group>.list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-bottom: 0
        }

        .card>.table,
        .card>.table-responsive>.table {
            margin-bottom: 0
        }

        .card>.table-responsive {
            border: 0
        }

        .card>.btn {
            border-radius: 0;
            width: 100%;
            padding-bottom: 16px;
            text-align: center
        }

        .card>.btn:last-child {
            border-bottom-right-radius: 2px;
            border-bottom-left-radius: 2px
        }

        .card.card-map {
            min-height: 280px
        }

        .modal.modal-left .modal-dialog>.modal-content,
        .modal.modal-right .modal-dialog>.modal-content {
            min-height: 100%
        }

        .card.card-map .card-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            border: 0;
            background-color: transparent
        }


        .mda-list {
            list-style-type: none;
            margin: 0;
            padding: 0
        }

        .mda-list>.mda-list-item {
            padding: 0 22px
        }

        .mda-list>.mda-list-item:after,
        .mda-list>.mda-list-item:before {
            content: " ";
            display: table
        }

        .mda-list>.mda-list-item>.mda-list-item-icon,
        .mda-list>.mda-list-item>.mda-list-item-img,
        .mda-list>.mda-list-item>.mda-list-item-initial {
            float: left;
            width: 48px;
            height: 48px;
            margin-top: 20px;
            margin-bottom: 8px;
            margin-right: 20px;
            border-radius: 50%
        }

        .mda-list>.mda-list-item>.mda-list-item-icon {
            line-height: 42px;
            text-align: center
        }

        .mda-list>.mda-list-item>.mda-list-item-icon>em,
        .mda-list>.mda-list-item>.mda-list-item-icon>i {
            line-height: inherit
        }

        .mda-list>.mda-list-item>.mda-list-item-initial {
            line-height: 50px;
            text-align: center;
            font-size: 22px;
            font-weight: 300
        }

        .mda-list>.mda-list-item>.mda-list-item-text {
            float: left;
            padding: 20px 0
        }

        .mda-list>.mda-list-item>.mda-list-item-text.mda-2-line {
            padding-top: 26px
        }

        .mda-list>.mda-list-item>.mda-list-item-text h3 {
            font-size: 16px;
            font-weight: 400;
            letter-spacing: .01em;
            margin: 0 0 6px;
            line-height: .75em
        }

        .mda-list>.mda-list-item>.mda-list-item-text h4 {
            font-size: 14px;
            letter-spacing: .01em;
            font-weight: 400;
            margin: 10px 0 5px;
            line-height: .75em
        }

        .mda-list>.mda-list-item>.mda-list-item-text p {
            font-size: 14px;
            font-weight: 500;
            margin: 0;
            line-height: 1.6em
        }

        .mda-list>.mda-list-item>.mda-list-item-img+.mda-list-item-text,
        .mda-list>.mda-list-item>.mda-list-item-initial+.mda-list-item-text {
            width: calc(100% - 68px)
        }

        .mda-list.mda-list-bordered>.mda-list-item {
            border-bottom: 1px solid rgba(162, 162, 162, .16)
        }

        .card>.mda-list-bordered>.mda-list-item:last-child {
            border-bottom: 0
        }

        .media {
            margin-top: 15px
        }

        .media:first-child {
            margin-top: 0
        }

        .media,
        .media-body {
            overflow: hidden;
            zoom: 1
        }

        .media-body {
            width: 10000px
        }

        .media-object.img-thumbnail {
            max-width: none
        }

        .container-overlap+.container-lg,
        .container-overlap+.container-md,
        .container-overlap+.container-sm,
        .container-overlap+.container-xs {
            padding-top: 0;
            margin-top: -32px;
        }

        .media-right,
        .media>.pull-right {
            padding-left: 10px
        }

        .media-left,
        .media>.pull-left {
            padding-right: 10px
        }

        .media-body,
        .media-left,
        .media-right {
            display: table-cell;
            vertical-align: top
        }

        .media-middle {
            vertical-align: middle
        }

        .media-bottom {
            vertical-align: bottom
        }

        .media-heading {
            margin-top: 0;
            margin-bottom: 5px
        }

        .media-list {
            padding-left: 0;
            list-style: none
        }

        .pop{
            border: 3px solid black;
            background-color: #F5F5F5;
            margin-left: 100px;
            position: absolute;
            height: 500px;
            width: 200px;
            right: 120px;
            top: 100px;
            z-index: 3;
            overflow: scroll;
        }

        #pop_frnds{
            visibility: collapse;
            top: 33px;
        }
        
        .inside button{
            margin-bottom: 5px;
        }

        #pop_not{
            visibility: collapse;
            top: 63px;
        }

        .inside{
            border-bottom: 1px solid rgba(162, 162, 162, .50);
            margin: 10px;
        }

        .bu button{
            background-color: yellowgreen;
        }

        .comment_to_post{
            margin-top: 10px;
            visibility: collapse;
        }

    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <section ui-view autoscroll="false" ng-class="app.viewAnimation" class="ng-scope container ng-fadeInLeftShort" style>
        <div ui-view class="ng-fadeInLeftShort ng-scope">
            <div class="container-overlap bg-indigo-500 ng-scope">

                <div class="media m0 pv">
                    <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb64"></a></div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading text-white">John Doe</h4>
                        <span class="text-white">Aliquam viverra nibh at ipsum dapibus pulvinar et eu ligula.</span>
                    </div>

                </div>
                <div class="bu">
                    <button type="button" class="btn btn-flat btn-primary" id="friends">Friends</button>
                    <button type="button" class="btn btn-flat btn-primary" id="notifications">Notifications</button>
                    <button type="button" class="btn btn-flat btn-primary" id="srch"><a href="./Friend-search.html">Search</a></button>
                </div>

                <div class="pop" id="pop_frnds">
                    <div class="inside">
                        <p>New friendship request from: Angela</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                    <div class="inside">
                        <p>New friendship request from: Harry</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                    <div class="inside">
                        <p>New friendship request from: Eren Yeşiltepe</p>
                        <button>Accept</button>
                        <button>Reject</button>
                    </div>
                </div>
                <div class="pop" id="pop_not" >
                    <div class="inside">
                        <p>Stephen Palmer shared a new post</p>
                    </div>
                    <div class="inside">
                        <p>My talking Tom liked your post</p>
                    </div>
                </div>

            </div>
            <div class="container-lg ng-scope">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action class="mt ng-pristine ng-valid">
                                    <div class="input-group mda-input-group">
                                        <div class="mda-form-group">
                                            <div class="mda-form-control">
                                                <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>" id="share_post_txt"></textarea>
                                                <div class="mda-form-control-line"></div>
                                                <label class="m0">What's on your mind?</label>
                                            </div><span class="mda-form-msg right">Any message here</span>
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success" style="margin-top:-44px" id="share_post">
                                                POST
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        <div class="posts">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>2 hours</span></small>
                                            </div>
                                        </div>
                                        <div class="p">Ut egestas consequat faucibus. Donec id lectus tortor. Maecenas at porta purus. Etiam feugiat risus massa. Vivamus fermentum libero vel felis aliquet interdum. </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like1">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment1">Comment</button>
                                        <div class="comment_to_post" id="comment1_to_post">
                                            <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                        </div>
                                        <div class="comment_to_post" id="comment1_by_user">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="card">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Ricky Wagner</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>10 hours</span></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="MaterialImg" class="fw img-responsive">
                                        <div class="card-item-text bg-transparent">
                                            <p>The sun was shinning</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like2">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment2">Comment</button>
                                        <div class="comment_to_post" id="comment2_to_post">
                                            <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                        </div>
                                        <div class="comment_to_post" id="comment2_by_user">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="card reader-block">
                                    <div class="card-heading">
                                        <div class="media m0">
                                            <div class="media-left"><a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="User" class="media-object img-circle thumb48"></a></div>
                                            <div class="media-body media-middle pt-sm">
                                                <p class="media-heading m0 text-bold">Stephen Palmer</p><small class="text-muted"><em class="ion-earth text-muted mr-sm"></em><span>Yesterday</span></small>
                                            </div>
                                        </div>
                                        <div class="p">
                                            <div class="mb">Donec a purus auctor dui hendrerit accumsan non quis augue nisl sed iaculis.</div><a href>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                            <a href><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Pic" class="mr-sm thumb48"></a>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-flat btn-primary like" id="like3">Like</button>
                                        <button type="button" class="btn btn-flat btn-primary comment" id="comment3">Comment</button>
                                    </div>
                                    <div class="comment_to_post" id="comment3_to_post">
                                        <textarea rows="1" aria-multiline="true" tabindex="0" aria-invalid="false" class="no-resize form-control" name="txt" value="<?= isset($txt) ? filter_var($txt, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "1" ?>"></textarea>
                                    </div>
                                    <div class="comment_to_post" id="comment3_by_user">
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="push-down"></div>
                        <div class="card card-transparent">
                            <h5 class="card-heading">Friends</h5>
                            <div class="mda-list">
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Eric Graves</a></h3>
                                        <div class="text-muted text-ellipsis">Ut ac nisi id mauris</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Bruce Ramos</a></h3>
                                        <div class="text-muted text-ellipsis">Sed lacus nisl luctus</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Marie Hall</a></h3>
                                        <div class="text-muted text-ellipsis">Donec congue sagittis mi</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Russell Hart</a></h3>
                                        <div class="text-muted text-ellipsis">Donec convallis arcu sit</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Eric Graves</a></h3>
                                        <div class="text-muted text-ellipsis">Ut ac nisi id mauris</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Jessie Cox</a></h3>
                                        <div class="text-muted text-ellipsis">Sed lacus nisl luctus</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Jonathan Soto</a></h3>
                                        <div class="text-muted text-ellipsis">Donec congue sagittis mi</div>
                                    </div>
                                </div>
                                <div class="mda-list-item"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="List user" class="mda-list-item-img thumb48">
                                    <div class="mda-list-item-text mda-2-line">
                                        <h3><a href="#">Guy Carpenter</a></h3>
                                        <div class="text-muted text-ellipsis">Donec convallis arcu sit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
        $i=3;
        $(`#share_post`).on(`click`, function(){
            $e = $("<div class='card-body'><div class='card'><div class='card-heading'><div class='media m0'><div class='media-left'><a href='#'><img src='https://bootdey.com/img/Content/avatar/avatar6.png' alt='User' class='media-object img-circle thumb48'></a></div><div class='media-body media-middle pt-sm'><p class='media-heading m0 text-bold'>Stephen Palmer</p><small class='text-muted'><em class='ion-earth text-muted mr-sm'></em><span>2 hours</span></small></div></div><div class='p'></div></div><div class='card-footer'><button type='button' class='btn btn-flat btn-primary like' id='like1'>Like</button><button type='button' class='btn btn-flat btn-primary comment' id='comment1'>Comment</button><div class='comment_to_post' id='comment1_to_post'><textarea rows='1' aria-multiline='true' tabindex='0' aria-invalid='false' class='no-resize form-control' name='txt'></textarea></div><div class='comment_to_post' id='comment1_by_user'></div></div></div></div>");
            
            $val=$(`#share_post_txt`).val();
            $(`.posts`).prepend($e);
            $(`.p`).text(`${$val}`);
        })

        $i=1;
        $(`#notifications`).on(`click`, function(){
            $(".pop").css("visibility", "collapse");
            $i++;
            $("#pop_not").css("visibility", "visible");
            if($i%2==1){
                $("#pop_not").css("visibility", "collapse");
            }
        });
        $i=1;
        $(`#friends`).on(`click`, function(){
            $(".pop").css("visibility", "collapse");
            $i++;
            $("#pop_frnds").css("visibility", "visible");
            if($i%2==1){
                $("#pop_frnds").css("visibility", "collapse");
            }
        });
        $i=1;
        $(`.like`).on(`click`, function(){
            $t=(this.id);
            $i++;
            $(`#${$t}`).css("background", "pink");
            $(`#${$t}`).text("Unlike");
            if($i%2==1){
                $(`#${$t}`).text("Like");
                $(`#${$t}`).css("background", "grey");
            }
        });
        $i=1;
        $(`.comment`).on(`click`, function(){
            $t = (this.id);
            
            if($i%2==1){
                $(`#${$t}_to_post`).css("visibility", "visible");
                $(`#${$t}`).text("Post");

            }else{
                $(`#${$t}_to_post`).css("visibility", "collapse");
                $(`#${$t}`).text("Comment");
                $val = $(`#${$t}_to_post>textarea`).val();
                $(`#${$t}_by_user`).css("visibility", "visible");

                $e = $("<div class='inside'><p></p></div>");
                $e.attr(`id`, `${$t}_by_user${$i}`);

                $(`#${$t}_by_user`).prepend($e);
                $(`#${$t}_by_user${$i}`).text(`${$val}`);
                
            }
            $i++;
        });
    </script>
</body>
</html>