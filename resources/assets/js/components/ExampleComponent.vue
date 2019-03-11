<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <datepicker :inline="true"></datepicker>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
    export default {
      components: {
        Datepicker
      },
        mounted() {

        }
    }
</script>
