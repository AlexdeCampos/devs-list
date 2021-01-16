<template>
  <div class="container grid-lg">
    <form @submit.prevent="submitDeveloper">
      <h3>Cadastro de Desenvolvedores</h3>
      <div class="form-container columns">
        <div class="column col-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label class="form-label">Nome</label>
            <input
              type="text"
              v-model="$v.developer.nome.$model"
              class="form-input"
            />
          </div>
        </div>
        <div class="column col-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label class="form-label"> Sexo </label>
            <select
              name="sexo"
              v-model="$v.developer.sexo.$model"
              class="form-select"
            >
              <option value=""></option>
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
            </select>
          </div>
        </div>
        <div class="column col-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label class="form-label">Dia de Nascimento</label>
            <input
              type="date"
              v-model="$v.developer.datanascimento.$model"
              class="form-input"
            />
          </div>
        </div>
        <div class="column col-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label class="form-label">Idade</label>
            <input
              type="number"
              v-model="$v.developer.idade.$model"
              class="form-input"
              min="0"
            />
          </div>
        </div>
        <div class="column col-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label class="form-label">Hobby</label>
            <input
              type="text"
              v-model="$v.developer.hobby.$model"
              class="form-input"
            />
          </div>
        </div>
        <div class="column col-6 col-md-6 col-sm-12 col-mr-auto form-button">
          <div class="form-group">
            <label class="form-label label-button">Button</label>
            <button
              :disabled="disabledDeveloperForm"
              class="btn btn-primary align-right"
            >
              Confirmar
            </button>
          </div>
        </div>
      </div>
    </form>
    <table class="table table-striped table-hover">
      <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Hobby</th>
        <th>Idade</th>
        <th>Nascimento</th>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        <tr v-for="devData in developerList.data" :key="devData.id">
          <td>{{ devData.id }}</td>
          <td>{{ devData.nome }}</td>
          <td>{{ devData.sexo | gender }}</td>
          <td>{{ devData.hobby }}</td>
          <td>{{ devData.idade }}</td>
          <td>{{ devData.datanascimento | date }}</td>
          <td>
            <button
              type="button"
              @click="getDev(devData.id)"
              class="btn btn-primary"
            >
              <i class="icon icon-edit"></i>
            </button>
          </td>
          <td>
            <button
              type="button"
              @click="deleteDev(devData.id)"
              class="btn btn-error"
            >
              <i class="icon icon-delete"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
      <paginator
        @change-page="fetchData"
        @change-quantity="fetchData"
        :page="page"
        :pages="pages"
        v-model="quantity"
      ></paginator>
  </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
import { required } from "vuelidate/lib/validators";
import axios from "axios";
import { VMoney } from "v-money";
import Paginator from "../components/Paginator.vue";

export default {
  components: { Paginator },
  computed: {},
  data() {
    return {
      loading: true,
      page: 1,
      pages: 1,
      quantity: 10,
      developer: {
        id: null,
        nome: "",
        sexo: "",
        idade: null,
        hobby: "",
        datanascimento: "",
      },
    };
  },
  computed: {
    ...mapState("developers", ["developerList", "returnMessage"]),
    disabledDeveloperForm() {
      return this.$v.developer.$invalid;
    },
  },
  methods: {
    ...mapActions("developers", [
      "listDevelopers",
      "deleteDeveloper",
      "newDeveloper",
      "getDeveloper",
      "editDeveloper",
    ]),
    async submitDeveloper() {
      try {
        if (this.developer.id) {
          await this.editDeveloper(this.developer);
        } else {
          await this.newDeveloper(this.developer);
        }
        this.$toaster.success(this.returnMessage);
      } catch (error) {
        this.$toaster.error(this.returnMessage);
      }
      this.clearFields();
    },
    async deleteDev(id) {
      console.log(id)
      try {
        await this.deleteDeveloper(id);
        this.$toaster.success(this.returnMessage);
      } catch (error) {
        this.$toaster.error(this.returnMessage);
      }
    },
    async getDev(id) {
      try {
        let { data, message } = await this.getDeveloper(id);
        this.developer = data;
      } catch (error) {
        this.clearFields();
        this.$toaster.error(this.returnMessage);
      }
    },
    async clearFields() {
      this.developer = {
        id: null,
        nome: "",
        sexo: "",
        idade: null,
        hobby: "",
        datanascimento: "",
      };
    },
    async fetchData(page = 1, quantity = 10) {
      try {
        await this.listDevelopers({
          page,
          quantity,
        });

        const pagination = this.developerList.pagination;
        this.page = pagination.page;
        this.pages = pagination.pages;
        this.quantity = pagination.quantity;
      } catch (error) {
        console.log(error);
      }
    },

  },
  async created() {
    await this.fetchData(this.page, this.quantity);
  },
  validations: {
    developer: {
      nome: {
        required,
      },
      sexo: {
        required,
      },
      datanascimento: {
        required,
      },
      idade: {
        required,
      },
      hobby: {
        required,
      },
    },
  },
};
</script>

<style scoped>
.container {
  padding: 10px;
}
.form-container {
  border: 1px solid #5755d9;
  border-radius: 10px;
  padding: 10px;
  margin-bottom: 10px;
}

.label-button {
  opacity: 0;
}

.form-button {
  display: flex;
  justify-content: flex-end;
  height: 100%;
}

.form-button button {
  align-self: flex-end;
}
</style> 