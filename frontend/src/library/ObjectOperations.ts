/**
 * This function will check if a given object has a certain property.
 */
function checkIfObjectHasProperty(
  objectToVerify: { [key: string]: unknown },
  property: string
): boolean {
  if (typeof objectToVerify === 'object') {
    return objectToVerify.hasOwnProperty(property);
  } else {
    return false;
  }
}

export { checkIfObjectHasProperty };
