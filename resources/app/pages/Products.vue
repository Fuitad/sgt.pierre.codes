<style scoped>
  th, td {
    text-align: left;
  }

  th:nth-child(2),
  td:nth-child(2) {
    width: 10%;
  }

  th:nth-child(3),
  td:nth-child(3) {
    width: 30%;
  }

  td:nth-child(4) {
    width: 15%;
  }

  th:nth-child(5),
  td:nth-child(5),
  th:nth-child(6),
  td:nth-child(6) {
    width: 10%;
  }

  td:nth-child(4) > input {
    text-transform: uppercase;
  }
</style>

<template>
  <h1>Products</h1>

  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>SKU</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th colspan="2">Stock</th>
            </tr>
          </thead>

          <tbody>

            <tr class="{{
              isEditing(model) ? 'editable-row' : 'non-editable-row'
            }}" v-for="model in collection" track-by="id">
              <td>{{ $index + 1 }}</td>

              <td>
                <span>{{ model.sku }}</span>
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="model.name"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="model.category"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="number" v-model="model.price | number"
                  max="100"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="number" v-model="model.stock | number"
                  max="100"
                  :disabled="!isEditing(model)">
              </td>

              <td>
                <div class="danger-action">
                  <button class="btn btn-sm btn-info btn-edit"
                    @click="startEdit(model)">
                    <icon name="edit"></icon>
                  </button>

                  <button class="btn btn-sm btn-danger btn-drop"
                    @click="dropModel(model)">
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
                <small>(AUTO)</small>
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="newModel.name">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="text" v-model="newModel.category">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="number" v-model="newModel.price | number"
                  max="100">
              </td>

              <td>
                <input class="form-control form-control-sm"
                  type="number" v-model="newModel.stock | number"
                  max="100">
              </td>

              <td>
                <button class="btn btn-success btn-sm"
                  @click="storeModel()">
                  <icon name="save"></icon>
                </button>

                <button class="btn btn-warning btn-sm" @click="cancelEdit()">
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
      modelName: 'product',
      editModel: null,
      newModel: null,
      emptyModel: {
        sku: null,
        category: null,
        name: null,
        price: null,
        stock: null
      },
      collection: {}
    }
  }
}, Model)

page.methods.toString = function (model, useHtmlEntities = true) {
  if (useHtmlEntities) {
    return `${model.sku}&mdash;${model.name}`
  } else {
    return `${model.sku}—${model.name}`
  }
}

export default page
</script>
