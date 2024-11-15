const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function Validator(options) {
  let selectorRules = {};

  function removeError(errorElement, errorDestructive, errorCustomClass) {
    errorElement.innerText = "";
    errorDestructive.classList.remove(
      errorCustomClass ? errorCustomClass : "input-destructive"
    );
  }

  function validate(
    inputElement,
    rule,
    errorElement,
    errorDestructive,
    errorCustomClass
  ) {
    let rules = selectorRules[rule.selector];
    let errorMessage;

    for (let i = 0; i < rules.length; i++) {
      errorMessage = rules[i](inputElement.value); // test function
      if (errorMessage) break;
    }

    if (errorMessage) {
      errorElement.innerText = errorMessage;
      errorDestructive.classList.add(
        errorCustomClass ? errorCustomClass : "input-destructive"
      );
    } else {
      removeError(errorElement, errorDestructive, errorCustomClass);
    }

    return !errorMessage; // true or false
  }

  const formElement = $(options.form);

  if (formElement) {
    let isFormValid = true;

    formElement.onsubmit = function (e) {
      e.preventDefault();

      // Validate form when submit
      options.rules.forEach(function (rule) {
        let inputElement = formElement.querySelector(rule.selector);

        if (inputElement.classList.contains("RatingInput-rating")) {
          validate(
            inputElement,
            rule,
            inputElement
              .closest(options.formGroupSelector)
              .querySelector(options.errorMessageSelector),
            inputElement.closest(options.errorDestructiveElement),
            "RatingInput-error"
          );
        }

        let isValid = validate(
          inputElement,
          rule,
          inputElement
            .closest(options.formGroupSelector)
            .querySelector(options.errorMessageSelector),
          inputElement.closest(options.errorDestructiveElement)
        );

        if (!isValid) {
          isFormValid = false;
        }
      });

      if (isFormValid) {
        // Submit form with JS
        if (typeof options.onSubmit === "function") {
          let successInput = formElement.querySelectorAll([
            "[name]:not([disabled])",
          ]);

          const data = Array.from(successInput).reduce((data, input) => {
            data[input.name] = input.value;
            return data;
          }, {});

          options.onSubmit({
            data: data,
          });
        }
        // Submit form with default behavior
        else {
          formElement.submit();
        }
      }
    };

    options.rules.forEach(function (rule) {
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test); // add rule to array
      } else {
        selectorRules[rule.selector] = [rule.test]; // create array
      }

      let inputElement = formElement.querySelector(rule.selector);

      let errorDestructive = inputElement.closest(
        options.errorDestructiveElement
      );

      let errorElement = inputElement
        .closest(options.formGroupSelector)
        .querySelector(options.errorMessageSelector);

      if (inputElement) {
        if (inputElement.classList.contains("RatingInput-rating")) {
          inputElement.addEventListener("click", function (e) {
            validate(
              inputElement,
              rule,
              errorElement,
              errorDestructive,
              "RatingInput-error"
            );
          });
        }

        inputElement.addEventListener("blur", function (e) {
          validate(inputElement, rule, errorElement, errorDestructive);
        });

        inputElement.addEventListener("input", function (e) {
          removeError(errorElement, errorDestructive);
        });
      }
    });
  }
}

// Rating input
const ratingInput = $(".RatingInput-rating");
const stars = $$(".RatingInput-star-icon");
let currentRating = 0;
stars.forEach((star, index) => {
  star.addEventListener("mouseenter", () => {
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("RatingInput-active");
    }
  });

  star.addEventListener("mouseleave", () => {
    for (let i = 0; i <= index; i++) {
      if (i >= currentRating) {
        stars[i].classList.remove("RatingInput-active");
      }
    }
  });

  star.addEventListener("click", () => {
    currentRating = index + 1;

    if (ratingInput.classList.contains("RatingInput-error")) {
      ratingInput.classList.remove("RatingInput-error");
      ratingInput.parentElement.querySelector(".error").innerText = "";
    }

    for (let i = 0; i <= index; i++) {
      stars[i].classList.add("RatingInput-active");
    }

    for (let i = index + 1; i < stars.length; i++) {
      stars[i].classList.remove("RatingInput-active");
    }
  });
});

Validator.isRequired = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.trim() ? undefined : message || "Vui lòng nhập trường này";
    },
  };
};

Validator.isEmail = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      return emailRegex.test(value)
        ? undefined
        : message || "Email không hợp lệ";
    },
  };
};

Validator.isPhone = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;

      return phoneRegex.test(value)
        ? undefined
        : message || "Số điện thoại không hợp lệ";
    },
  };
};

Validator.isRequiredRating = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return currentRating > 0
        ? undefined
        : message || "Vui lòng nhập trường này";
    },
  };
};


Validator({
    form: "#form-review",
    formGroupSelector: ".form-group",
    errorMessageSelector: ".error",
    errorDestructiveElement: "div",
    rules: [
      Validator.isRequired("#name", "Bạn phải nhập họ và tên"),
      Validator.isRequired("#email"),
      Validator.isEmail("#email", "Email không hợp lệ"),
      Validator.isRequired("#phone", "Bạn phải nhập số điện thoại"),
      Validator.isPhone("#phone"),
      Validator.isRequired("#comment", "Bạn phải nhập đánh giá"),
      Validator.isRequiredRating(".RatingInput-rating", "Bạn phải chọn rating"),
    ],
    onSubmit: function (data) {
      data.rating = currentRating;
      // call API
      console.log(data);
    },
  });
  

export {Validator, currentRating};