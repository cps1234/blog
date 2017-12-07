@extends('layouts.app')
@section('content')
<div class="container" id="blog-details">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Post Details</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('manage_blog') }}">Back</a>
            </div>
        </div>
    </div>

    <div class="blog-list">
        <h3>@{{ item.title }}</h3>
        <div>Written by <b>@{{ item.user.name }}</b> on @{{ item.created_at }}</div>
        <br>
        <div>@{{ item.description }}</div>        
    </div>
    <br>
    <h5>Comments(@{{item.comments_count}})</h5>
    <form method="POST" v-on:submit.prevent="createComment">
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <input type="text" name="text" class="form-control" v-model="newComment.text" placeholder="Enter Comments Here" />
                    <span v-if="formErrors['text']" class="error text-danger">@{{ formErrors['text'] }}</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>  
    </form>

    <div class="comment-list" v-for="comment in item.comments">
        <div class="row">
            <div class="col-sm-8">
                @{{ comment.text }}
            </div>
            <div class="col-sm-4 text-right">
                - By <b>@{{ comment.user.name }}</b> @{{ comment.created_at }}
            </div>
        </div> 
    </div>
     
</div>
@endsection

@section("javascript")
    <script type="text/javascript">
        Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

        var vm = new Vue({

          el: '#blog-details',

          data: {
            item: {},
            newComment: {"text": ""}
          },

          ready : function(){
                this.getDetails();
          },

          methods : {

                getDetails: function(){
                  this.$http.get(APP_URL+'/blogs/{{ $id }}').then((response) => {
                    response = response.json();
                    this.$set('item', response.data);
                  });
                },


                createComment: function(){
                      var input = this.newComment;
                      this.$http.post(APP_URL+'/blog/addcomment/{{ $id }}',input).then((response) => {
                            this.getDetails();
                            this.newComment = {'text':''};
                            toastr.success('Comment added Successfully.', 'Success Alert', {timeOut: 5000});
                      }, (response) => {
                           this.formErrors = response.json().data;
                    });
                },
          }

        });
    </script>
@endsection