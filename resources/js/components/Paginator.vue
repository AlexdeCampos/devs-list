<template>
<div class="paginator">

  <div class="d-flex pagination-container">
    <div>
      <ul class="pagination">
        <li
          class="page-item c-hand"
          :class="{ disabled: firstPage }"
          @click="previousPage"
        >
          <div class="nav-button"><i class="fas fa-chevron-left"></i></div>
        </li>
        <li class="page-item c-hand" :class="{ active: firstPage }">
          <a @click="toPage(1)">1</a>
        </li>
        <li class="page-item" v-if="(currentPage - limitPages) &gt; 1">
          <a>...</a>
        </li>
        <div v-for="page in pages" :key="page">
          <li
            class="page-item c-hand"
            :class="{ active: page === currentPage }"
            v-if="page &gt; 1 &amp;&amp; page &lt; pages &amp;&amp; (page - currentPage) &lt; limitPages &amp;&amp; (currentPage - page) &lt; limitPages"
          >
            <a @click="toPage(page)">{{ page }}</a>
          </li>
        </div>
        <li class="page-item" v-if="(pages - currentPage) &gt; limitPages">
          <a>...</a>
        </li>
        <li
          class="page-item c-hand"
          :class="{ active: lastPage }"
          v-if="pages &gt; 1"
        >
          <a @click="toPage(pages)">{{ pages }}</a>
        </li>
        <li
          class="page-item c-hand"
          :class="{ disabled: lastPage }"
          @click="nextPage"
        >
          <div class="nav-button"><i class="fas fa-chevron-right"></i></div>
        </li>
      </ul>
    </div>
    <div class="d-flex " >
      <label class="form-label"> Itens por página:</label>
      <select v-model="quantity" class="form-select">
        <option v-for="option in [10, 20, 50, 100]" :key="option">
          {{ option }}
        </option>
      </select>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    page: { type: Number, required: true },
    pages: { type: Number, required: true },
    limitPages: { type: Number, default: 3 },
    value: { required: true },
  },
  computed: {
    currentPage() {
      return this.page;
    },
    firstPage() {
      return Boolean(this.currentPage <= 1);
    },

    lastPage() {
      return Boolean(this.currentPage >= this.pages);
    },
    quantity: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },

  methods: {
    previousPage() {
      if (!this.firstPage) {
        this.navigateToPage(this.currentPage - 1);
      }
    },

    toPage(pageToNavigate) {
      if (pageToNavigate !== this.currentPage) {
        this.navigateToPage(pageToNavigate);
      }
    },

    nextPage() {
      if (!this.lastPage) {
        this.navigateToPage(this.currentPage + 1);
      }
    },

    navigateToPage(page) {
      this.$emit("change-page", page, this.quantity);
    },
  },
  watch: {
    quantity(newValue) {
      this.$emit("change-quantity", 1, newValue);
    },
  },
};
</script>

<style scoped>
.pagination {
  align-items: center;
}
.pagination .disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
.pagination .nav-button {
  display: flex;
  align-items: center;
}
.pagination .nav-button i {
  color: #5755d9;
  font-size: 18px;
  padding: 0 10px;
}
.pagination-container {
 justify-content:space-between;
 align-items:center;
}

.paginator{
  widows: 100vw;
}

.form-label{
  white-space: nowrap;
  align-items:center;
  margin-right: 10px;
}
</style>