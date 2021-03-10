from lpaapi import *

lpaId = makeNewLpa()
setLpaType(lpaId, 'property-and-financial')
setDonor(lpaId)
setPrimaryAttorneyDecisions(lpaId)
addPrimaryAttorney(lpaId)
addReplacementAttorney(lpaId)
setReplacementAttorneyDecisions(lpaId)
setCertificateProvider(lpaId)
addPersonToNotify(lpaId)
setInstruction(lpaId)
setPreference(lpaId)
setWhoIsRegistering(lpaId)
getPdf1(lpaId)
deletePrimaryAttorney(lpaId)
deleteReplacementAttorney(lpaId)
deleteLpa(lpaId)
