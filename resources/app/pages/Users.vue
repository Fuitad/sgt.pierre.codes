<style scoped>
  th, td {
    text-align: left;
  }

  th:nth-child(2),
  td:nth-child(2) {
    width: 35%;
  }

  th:nth-child(3),
  td:nth-child(3) {
    width: 25%;
  }

  td:nth-child(4) {
    width: 20%;
  }
</style>

<template>
  <h1>Users</h1>

  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Email</th>
              <th>Username</th>
              <th colspan="2">Role</th>
            </tr>
          </thead>

          <tbody>

            <tr class="{{
              isEditing(model) ? 'editable-row' : 'non-editable-row'
            }}" v-for="model in collection" track-by="id">
              <td>{{ $index + 1 }}</td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="model.email"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="model.username"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <select class="form-control" v-model="model.role"
                  :disabled="!isEditing(model)">
                  <option value="customer"
                    :selected="model.role === 'customer'"
                  >Customer</option>
                  <option value="admin"
                    :selected="model.role === 'admin'"
                  >Admin</option>
                </select>
              </td>

              <td>
                <div class="danger-action">
                  <button class="btn btn-sm btn-info btn-edit"
                    @click="startEdit(model)">
                    <icon name="edit"></icon>
                  </button>

                  <button class="btn btn-sm btn-danger btn-drop"
                    @click="dropModel(model)" v-if="model.role !== 'admin'">
                    <icon name="trash-o"></icon>
                  </button>
                </div>

                <div class="edit-action">
                  <button class="btn btn-success btn-sm"
                    @click="updateModel(model)">
                    <icon name="save"></icon>
                  </button>

                  <button class="btn btn-warning btn-sm" @click="cancelEdit()">
                    <icon name="close"></icon>
                  </button>
                </div>
              </td>

            </tr>

            <tr class="editable-row" v-if="newModel">
              <td><icon name="plus"></icon></td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="newModel.email">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="newModel.username">
              </td>

              <td>
                <select class="form-control" v-model="newModel.role">
                  <option value="" selected disabled></option>
                  <option value="customer">Customer</option>
                  <option value="admin">Admin</option>
                </select>
              </td>

              <td>
                <button class="btn btn-success btn-sm"
                  @click="storeModel()">
                  <icon name="save"></icon>
                </button>

                <button class="btn btn-warning btn-sm" @click="resetCreate()">
                  <icon name="repeat"></icon>
                </button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import extend from '../lib/object-extend.js'
import Model from '../lib/model'
import Icon from 'vue-awesome'

var page = extend({
  components: {
    Icon
  },

  data() {
    return {
      modelName: 'user',
      editModel: null,
      originalModel: null,
      newModel: null,
      emptyModel: {
        email: null,
        username: null,
        role: null
      },
      collection: {}
    }
  }
}, Model)

page.methods.toString = function (model, useHtmlEntities = true) {
  if (useHtmlEntities) {
    return `${model.username} &lt;${model.email}&gt;`
  } else {
    return `${model.username} <${model.email}>`
  }
}

export default page
</script>
