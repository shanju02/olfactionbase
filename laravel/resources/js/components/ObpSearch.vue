<template>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-12">
            <input
                type="text"
                name="name"
                id="name"
                placeholder="UniProt Id"
                class="form-control d-inline"
                style="width: 45%"
                v-model="selectedUniProt"
            >
            <div id="opt" style="width: 10%; display: inline">-OR-</div>
            <select
                name="organism"
                id="organism"
                class="form-select d-inline"
                style="width: 45%"
                v-model="selectedOrganism"
            >
                <option value="">Select Organism</option>
                <option v-for="item in organisms" :key="item.organism" :value="item.organism">{{ item.organism }}</option>
            </select>
            <div v-show="errorMsg !== ''" class="mt-2 text-danger">{{ errorMsg }}</div>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
            <button type="button" @click="handleSearch" name="btnSearch" id="btnSearch" class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ObpSearch',
    props: {
        organismDataUrl: String,
        searchFormUrl: String,
    },
    data() {
        return {
            organisms: [],
            selectedUniProt: "",
            selectedOrganism: "",
            errorMsg: ""
        }
    },
    mounted() {
        this.getOrganisms()
    },
    methods: {
        makeJsonObject(data) {
            if (typeof data === 'string') {
                return JSON.parse(data)
            }
            return data
        },
        getOrganisms() {
            axios.get(this.organismDataUrl).then((response) => {
                this.organisms = this.makeJsonObject(response.data)
            }).catch((err) => {
                console.log(err)
            })
        },
        handleSearch() {
            if (this.selectedUniProt !== "" || this.selectedOrganism !== "") {
                window.location.href = this.searchFormUrl + '?name=' + this.selectedUniProt + '&organism=' + this.selectedOrganism
            } else {
                this.errorMsg = "Please enter a value to search."
            }
        }
    }
};
</script>

<style scoped>

</style>
