<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Viagens</div>

          <div class="card-body">
            <form method="post" v-on:submit.prevent="calculate">
              <b-row>
                <b-col
                  ><b-form-select
                    v-model="trip.from"
                    :options="cities"
                  ></b-form-select
                ></b-col>
                <b-col
                  ><b-form-select
                    v-model="trip.to"
                    :options="cities"
                  ></b-form-select
                ></b-col>
                <b-col
                  ><button
                    type="submit"
                    class="btn btn-primary"
                    v-if="!trip.calculated"
                  >
                    Calcular
                  </button>
                  <b-button
                    variant="primary"
                    @click="save"
                    v-if="trip.calculated"
                    >Salvar</b-button
                  >
                </b-col>
                <b-col>
                  <span>Distancia(KM):{{ trip.distance }}</span>
                  <span>Preco:{{ trip.price | toCurrency }}</span>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-table
                    striped
                    hover
                    :items="trips"
                    :fields="fields"
                    dark="true"
                  ></b-table>
                </b-col>
              </b-row>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      trip: {
        from: null,
        to: null,
        price: 0,
        distance: 0,
        calculated: false,
      },
      cities: [],
      trips: [],
      fields: [
        { key: "from", label: "De" },
        { key: "to", label: "Para" },
        { key: "distance", label: "Distancia" },
        { key: "price", label: "Preco" },
      ],
    };
  },
  methods: {
    calculate() {
      if (this.validate()) {
        const payload = this.trip;
        payload.user = this.$store.state.user.id;
        axios
          .post(`${window.location.origin}/api/trip/calculate`, payload)
          .then((response) => {
            this.trip.price = response.data.price;
            this.trip.distance = response.data.distance;
            this.trip.calculated = true;
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
    save() {
      if (this.validate()) {
        const payload = this.trip;
        payload.user = this.$store.state.user.id;
        axios
          .post(`${window.location.origin}/api/trip/save`, payload)
          .then((response) => {
            this.trips.push({
              from: this.cities.filter((option) => {
                return option.value == this.trip.from;
              })[0].text,
              to: this.cities.filter((option) => {
                return option.value == this.trip.to;
              })[0].text,
              price: this.trip.price,
              distance: this.trip.distance,
            });
            this.reset();
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
    validate() {
      if (this.trip.from == 0 || this.trip.to == 0) {
        alert("Selecione a origem e o destino da viagem primeiro.");
        return false;
      }

      if (this.trip.from == this.trip.to) {
        alert("Origem e destino precisam ser diferentes.");
        return false;
      }
      return true;
    },
    reset() {
      this.trip = {
        from: 0,
        to: 0,
        price: 0,
        distance: 0,
        calculated: false,
      };
    },
  },
  mounted() {
    if (this.$store.state.user.id == undefined) {
      this.$router.push("signin");
      return;
    }

    axios
      .get(`${window.location.origin}/api/cities`)
      .then((response) => {
        this.cities = [];
        this.cities.push({ value: 0, text: "Selecione uma Cidade" });
        response.data.forEach((city) => {
          this.cities.push({ value: city.id, text: city.name });
        });
        this.trip.from = 0;
        this.trip.to = 0;

        axios
          .get(
            `${window.location.origin}/api/user/${this.$store.state.user.id}/trips`
          )
          .then((response) => {
            response.data.forEach((trip) => {
              this.trips.push({
                from: this.cities.filter((option) => {
                  return option.value == trip.from;
                })[0].text,
                to: this.cities.filter((option) => {
                  return option.value == trip.to;
                })[0].text,
                price: trip.price,
                distance: trip.distance,
              });
            });
          })
          .catch((err) => {
            console.error(err);
          });
      })
      .catch((err) => {
        console.error(err);
      });
  },
};
</script>

<style>
.row {
  margin-top: 1rem;
  margin-bottom: 1rem;
}
</style>
