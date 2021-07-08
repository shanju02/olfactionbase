<template>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-12">
            <input
                type="text"
                name="smiles"
                id="smiles"
                placeholder="SMILE"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedSmile"
            >
            <div id="opt" style="width: 10%; display: inline">-OR-</div>
            <input
                type="text"
                name="casrn"
                id="casrn"
                placeholder="CAS-NO"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedCasrn"
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
    name: 'ChemicalSearch',
    props: {
        searchFormUrl: String,
    },
    data() {
        return {
            selectedSmile: "",
            selectedCasrn: "",
            errorMsg: ""
        }
    },
    methods: {
        handleSearch() {
            if (this.selectedSmile !== "" || this.selectedCasrn !== "") {
                window.location.href = this.searchFormUrl + '?smiles=' + this.selectedSmile + '&casrn=' + this.selectedCasrn
            } else {
                this.errorMsg = "Please enter either smile or CAS-NO."
            }
        }
    }
};
</script>

<style scoped>

</style>
