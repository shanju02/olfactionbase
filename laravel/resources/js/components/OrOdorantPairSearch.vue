<template>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-12">
            <input
                type="text"
                name="casrn"
                id="casrn"
                placeholder="Odorant CAS-NO"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedCasrn"
            >
            <div id="opt" style="width: 10%; display: inline">-OR-</div>
            <input
                type="text"
                name="receptor_name"
                id="receptor_name"
                placeholder="Receptor Name"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedReceptorName"
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
    name: 'OrOdorantPairSearch',
    props: {
        searchFormUrl: String,
    },
    data() {
        return {
            selectedReceptorName: "",
            selectedCasrn: "",
            errorMsg: ""
        }
    },
    methods: {
        handleSearch() {
            if (this.selectedReceptorName !== "" || this.selectedCasrn !== "") {
                window.location.href = this.searchFormUrl + '?casrn=' + this.selectedCasrn + '&receptor_name=' + this.selectedReceptorName
            } else {
                this.errorMsg = "Please enter a value to search."
            }
        }
    }
};
</script>

<style scoped>

</style>
