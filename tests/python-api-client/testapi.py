from lpaapi import *

lpaId = makeNewLpa()
setLpaType(lpaId, 'property-and-financial')
setDonor(lpaId)
setPrimaryAttorneyDecisions(lpaId, 'property-and-financial')
addPrimaryAttorney(lpaId)
addSecondPrimaryAttorney(lpaId)
addReplacementAttorney(lpaId)
setReplacementAttorneyDecisions(lpaId)
setCertificateProvider(lpaId)
addPersonToNotify(lpaId)
setInstruction(lpaId)
setPreference(lpaId)
setWhoIsRegistering(lpaId)
getPdf1(lpaId)
deletePrimaryAttorney(lpaId)
deletePrimaryAttorney(lpaId, 2)
deleteReplacementAttorney(lpaId)
deleteLpa(lpaId)
