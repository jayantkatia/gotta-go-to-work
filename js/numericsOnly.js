function getOnlyNumerics() {
    var kc = event.keyCode;//gives ASCII value
    //Only Numerics are allowed
    if (!(kc >= 48 && kc <= 57))
      return false;
  }