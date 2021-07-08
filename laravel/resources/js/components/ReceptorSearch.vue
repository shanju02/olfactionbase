<template>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-12">
            <select
                name="organism"
                id="organism"
                class="form-select d-inline"
                style="width: 45%"
                v-model="selectedOrganism"
            >
                <option value="">Select Organism</option>
                <option value="Human">Human</option>
                <option value="Mus musculus">Mus musculus</option>
            </select>
            <div id="opt" style="width: 10%; display: inline">-OR-</div>
            <input
                type="text"
                name="gen_bank"
                id="gen_bank"
                placeholder="GenBank Accession No"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedGenBank"
            >
            <div v-show="errorMsg !== ''" class="mt-2 text-danger">{{ errorMsg }}</div>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
            <button type="button" @click="handleSearch" name="btnSearch" id="btnSearch" class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ReceptorSearch',
    props: {
        searchFormUrl: String,
    },
    data() {
        return {
            selectedOrganism: "",
            selectedGenBank: "",
            errorMsg: ""
        }
    },
    methods: {
        handleSearch() {
            if (this.selectedOrganism !== "" || this.selectedGenBank !== "") {
                window.location.href = this.searchFormUrl + '?gen_bank=' + this.selectedGenBank + '&organism=' + this.selectedOrganism
            } else {
                this.errorMsg = "Please enter a value to search."
            }
        }
    }
};
</script>

<style scoped>

</style>
