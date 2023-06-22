/**
 * This function will determine the input type.
 */
function determineTheInputType(
  inputName: string | number
): 'date' | 'email' | 'file' | 'number' | 'password'| 'search' | 'tel' | 'text' | 'textarea' | 'time' | 'url' | undefined {
  if (typeof inputName === 'string') {
    if (inputName === 'email' || inputName === 'email_address') {
      return 'email';
    }
    if (inputName === 'password' || inputName === 'confirm_password') {
      return 'password';
    }
    if (inputName === 'phone' || inputName === 'phone_number') {
      return 'tel';
    }
  } else {
    return undefined;
  }
}

export {
  determineTheInputType,
};
