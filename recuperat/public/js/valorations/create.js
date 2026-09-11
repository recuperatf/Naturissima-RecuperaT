$(function () {
    $("#btn_add_excercise").click(function () {
        let description = $(
            "#home_physiotherapy_program_exercises_description"
        ).val();
        let series = $("#home_physiotherapy_program_exercises_series").val();
        let reps = $("#home_physiotherapy_program_exercises_reps").val();
        let divHiddenInputs = $("#div_excersises_hidden");
        let divInputs = $("#div_excersises");
        let divHiddenWrapper = $("<div></div>", {
            class: "div_hidden_inputs_excercise",
        });
        let divInputsColWrapper = $("<div></div>", { class: "col-md-12" });
        let divInputsRowWrapper = $("<div></div>", { class: "row" });
        divInputsColWrapper.append(divInputsRowWrapper);
        let currentIndex = divHiddenInputs.children().length + 1;

        let inputDescription = $("<div></div>", {
            class: "col-md-8",
            html: $("<input></input>", {
                disabled: true,
                value: description,
                class: "form-control",
            }),
        });
        let inputSeries = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: series,
                class: "form-control",
            }),
        });
        let inputReps = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: reps,
                class: "form-control",
            }),
        });

        let hiddenDescription = $("<input></input>", {
            name:
                "home_physiotherapy_program_exercises[" +
                currentIndex +
                "][description]",
            type: "hidden",
            value: description,
        });
        let hiddenSeries = $("<input></input>", {
            name:
                "home_physiotherapy_program_exercises[" +
                currentIndex +
                "][series]",
            type: "hidden",
            value: series,
        });
        let hiddenReps = $("<input></input>", {
            name:
                "home_physiotherapy_program_exercises[" +
                currentIndex +
                "][reps]",
            type: "hidden",
            value: reps,
        });

        divInputsRowWrapper.append(inputDescription);
        divInputsRowWrapper.append(inputSeries);
        divInputsRowWrapper.append(inputReps);

        divHiddenWrapper.append(hiddenDescription);
        divHiddenWrapper.append(hiddenSeries);
        divHiddenWrapper.append(hiddenReps);

        divInputs.append(divInputsColWrapper);
        divHiddenInputs.append(divHiddenWrapper);
        console.log(divHiddenWrapper);
        updateRows("[class=div_hidden_inputs_excercise]");
    });
    $("#btn_add_afs").click(function () {
        console.log("a");
        let name = $("#home_physiotherapy_program_af_name").val();
        let indications = $(
            "#home_physiotherapy_program_af_indication"
        ).val();
        let precautions = $(
            "#home_physiotherapy_program_af_precautions"
        ).val();
        let divHiddenInputs = $("#div_af_hidden");
        let divInputs = $("#div_af");
        let divHiddenWrapper = $("<div></div>", {
            class: "div_hidden_inputs_af",
        });
        let divInputsColWrapper = $("<div></div>", { class: "col-md-12" });
        let divInputsRowWrapper = $("<div></div>", { class: "row" });
        divInputsColWrapper.append(divInputsRowWrapper);
        let currentIndex = divHiddenInputs.children().length + 1;

        let inputName = $("<div></div>", {
            class: "col-md-8",
            html: $("<input></input>", {
                disabled: true,
                value: name,
                class: "form-control",
            }),
        });
        let inputIndications = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: indications,
                class: "form-control",
            }),
        });
        let inputPrecautions = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: precautions,
                class: "form-control",
            }),
        });

        let hiddenName = $("<input></input>", {
            name: "home_physiotherapy_program_afs[" + currentIndex + "][name]",
            type: "hidden",
            value: name,
        });
        let hiddenIndications = $("<input></input>", {
            name:
                "home_physiotherapy_program_afs[" +
                currentIndex +
                "][indications]",
            type: "hidden",
            value: indications,
        });
        let hiddenPrecautions = $("<input></input>", {
            name:
                "home_physiotherapy_program_afs[" +
                currentIndex +
                "][precautions]",
            type: "hidden",
            value: precautions,
        });

        divInputsRowWrapper.append(inputName);
        divInputsRowWrapper.append(inputIndications);
        divInputsRowWrapper.append(inputPrecautions);

        divHiddenWrapper.append(hiddenName);
        divHiddenWrapper.append(hiddenIndications);
        divHiddenWrapper.append(hiddenPrecautions);

        divInputs.append(divInputsColWrapper);
        divHiddenInputs.append(divHiddenWrapper);
        console.log(divHiddenWrapper);
        updateRows("[class=div_hidden_inputs_af]");
    });

    ("#btn_add_meds").click(function () {
        console.log("a");
        let name = $("#home_physiotherapy_program_meds_name").val();
        let indications = $(
            "#home_physiotherapy_program_meds_indication"
        ).val();
        let precautions = $(
            "#home_physiotherapy_program_meds_precautions"
        ).val();
        let divHiddenInputs = $("#div_meds_hidden");
        let divInputs = $("#div_meds");
        let divHiddenWrapper = $("<div></div>", {
            class: "div_hidden_inputs_meds",
        });
        let divInputsColWrapper = $("<div></div>", { class: "col-md-12" });
        let divInputsRowWrapper = $("<div></div>", { class: "row" });
        divInputsColWrapper.append(divInputsRowWrapper);
        let currentIndex = divHiddenInputs.children().length + 1;

        let inputName = $("<div></div>", {
            class: "col-md-8",
            html: $("<input></input>", {
                disabled: true,
                value: name,
                class: "form-control",
            }),
        });
        let inputIndications = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: indications,
                class: "form-control",
            }),
        });
        let inputPrecautions = $("<div></div>", {
            class: "col-md-2",
            html: $("<input></input>", {
                disabled: true,
                value: precautions,
                class: "form-control",
            }),
        });

        let hiddenName = $("<input></input>", {
            name: "home_physiotherapy_program_meds[" + currentIndex + "][name]",
            type: "hidden",
            value: name,
        });
        let hiddenIndications = $("<input></input>", {
            name:
                "home_physiotherapy_program_meds[" +
                currentIndex +
                "][indications]",
            type: "hidden",
            value: indications,
        });
        let hiddenPrecautions = $("<input></input>", {
            name:
                "home_physiotherapy_program_meds[" +
                currentIndex +
                "][precautions]",
            type: "hidden",
            value: precautions,
        });

        divInputsRowWrapper.append(inputName);
        divInputsRowWrapper.append(inputIndications);
        divInputsRowWrapper.append(inputPrecautions);

        divHiddenWrapper.append(hiddenName);
        divHiddenWrapper.append(hiddenIndications);
        divHiddenWrapper.append(hiddenPrecautions);

        divInputs.append(divInputsColWrapper);
        divHiddenInputs.append(divHiddenWrapper);
        console.log(divHiddenWrapper);
        updateRows("[class=div_hidden_inputs_meds]");
    });

    $("#btn_add_contraindications").click(function () {
        let contraindication = $(
            "#home_physiotherapy_program_contraindications_contraindication"
        ).val();

        let divHiddenInputs = $("#div_contraindications_hidden");
        let divInputs = $("#div_contraindications");
        let divHiddenWrapper = $("<div></div>", {
            class: "div_hidden_inputs_contraindications",
        });
        let divInputsColWrapper = $("<div></div>", { class: "col-md-12" });
        let divInputsRowWrapper = $("<div></div>", { class: "row" });
        divInputsColWrapper.append(divInputsRowWrapper);
        let currentIndex = divHiddenInputs.children().length + 1;

        let inputContraindication = $("<div></div>", {
            class: "col-md-12",
            html: $("<input></input>", {
                disabled: true,
                value: contraindication,
                class: "form-control",
            }),
        });

        let hiddenContrindication = $("<input></input>", {
            name:
                "home_physiotherapy_program_contraindications[" +
                currentIndex +
                "][contraindication]",
            type: "hidden",
            value: contraindication,
        });

        divInputsRowWrapper.append(inputContraindication);

        divHiddenWrapper.append(hiddenContrindication);

        divInputs.append(divInputsColWrapper);
        divHiddenInputs.append(divHiddenWrapper);
        console.log(divHiddenWrapper);
        updateRows("[class=div_hidden_inputs_contraindications]");
    });

    $("#btn_add_masajes").click(function () {
        let name = $("#home_physiotherapy_program_masaje_name").val();

        let divHiddenInputs = $("#div_masajes_hidden");
        let divInputs = $("#div_masajes");
        let divHiddenWrapper = $("<div></div>", {
            class: "div_hidden_inputs_masajes",
        });
        let divInputsColWrapper = $("<div></div>", { class: "col-md-12" });
        let divInputsRowWrapper = $("<div></div>", { class: "row" });
        divInputsColWrapper.append(divInputsRowWrapper);
        let currentIndex = divHiddenInputs.children().length + 1;

        let inputName = $("<div></div>", {
            class: "col-md-12",
            html: $("<input></input>", {
                disabled: true,
                value: name,
                class: "form-control",
            }),
        });

        let hiddenName = $("<input></input>", {
            name:
                "home_physiotherapy_program_masajes[" +
                currentIndex +
                "][name]",
            type: "hidden",
            value: name,
        });

        divInputsRowWrapper.append(inputName);

        divHiddenWrapper.append(hiddenName);

        divInputs.append(divInputsColWrapper);
        divHiddenInputs.append(divHiddenWrapper);
        console.log(divHiddenWrapper);
        updateRows("[class=div_hidden_inputs_masajes]");
    });
});

function updateRows(selector) {
    $(selector).each((row_key, row_val) => {
        $(row_val)
            .find("input")
            .each((input_key, input_val) => {
                const regex = /\[\d+\]/;
                name = input_val.name.replace(regex, "[" + row_key + "]");
                $(input_val).attr("name", name);
            });
    });
}
