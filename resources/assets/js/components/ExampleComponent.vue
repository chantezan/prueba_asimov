<template>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-4">
                    <datepicker :monday-first="true" @selected="selected" :disabledDates="disabledDates" :language="es" :inline="true"></datepicker>

                <h4>Ingrese sus datos</h4>
                <form ref="form" v-on:submit.prevent>
                    <div class="form-row">
                        <div class="col-4">
                            <input type="text" v-model="name" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-3">
                            <input type="text" v-model="last_name" class="form-control" placeholder="Apellido" required>
                        </div>
                        <div class="col-3">
                            <input type="email" v-model="email" class="form-control" placeholder="Email" required>
                        </div>

                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-4">
                            <input type="text" v-model="phone" class="form-control" placeholder="Telefono">
                        </div>
                        <div class="col-4">
                            <select v-model="hour_selected" class="form-control">
                                <option v-for="hour in hours_avalaible" v-text="hour"></option>
                            </select>
                        </div>
                        <button v-show="false" ref="buton" type="submit">asd</button>
                        <div class="col-2">
                            <button type="button" @click="send" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- Modal -->


    </div>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
  import {en, es} from 'vuejs-datepicker/dist/locale';
  import axios from 'axios';
    export default {
      data: function () {
        return {
          date_selected : null,
          hour_selected : null,
          name : null,
          last_name : null,
          email : null,
          phone : null,
          es: es,
          disabledDates: {
            days: [0,6]
          },
          hours_avalaible :[],
          hours_to_search: ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00']
        }
      },
      components: {
        Datepicker
      },
      methods: {
        send:function () {
          this.$refs.buton.click();
          if(this.$refs.form.checkValidity()){
            axios.post('/prueba_asimov/public/save_book',{date:this.date,name:this.name,last_name:this.last_name,phone:this.phone,email:this.email})
                .then(function (response) {
                  alert("hora guardada con exito")
                  location.reload();
                }).catch(function (reason) { alert("hubo un problema al guardar su hora") });;
          }
        },
        selected : function(e) {
          let self = this;
          var dateFormat = require('dateformat');
            var start_date = dateFormat(e, "yyyy-mm-dd")
          this.date_selected = start_date;
          e.setDate(e.getDate() + 1);
          var end_date = dateFormat(e, "yyyy-mm-dd")
          axios.post('/prueba_asimov/public/show',{to:end_date,from:start_date})
              .then(function (response) {
                console.log(response.data);
                self.hours_to_search.forEach(function(element) {
                  var is = response.data.find(function(element2) {
                    return element2.date.substring(11,16) == element;
                  });
                  if(is == undefined){
                    self.hours_avalaible.push(element);
                  }
                });
              }).catch(function (reason) { alert("no se pudo traer horas") });
        },
      },
      computed: {
        // a computed getter
        date: function () {
          // `this` points to the vm instance
          return this.date_selected + " " + this.hour_selected;
        }
      }
    }
</script>
