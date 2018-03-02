import numpy as np
import matplotlib.pyplot as plt
from sklearn import cross_validation
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis
from matplotlib import colors
# %% Read data from csv file
A = np.loadtxt('dataset.txt', delimiter=',')
#Get the targets (first column of file)
y = A[:, 0]
#Remove targets from input data
A = A[:, 1:]

lda = LinearDiscriminantAnalysis(n_components=2)
lda.fit(A, y)
drA = lda.transform(A)

# %% Data extracted; perform LDA
lda = LinearDiscriminantAnalysis()
k_fold = cross_validation.KFold(len(A), 3, shuffle=True)
print('LDA Results: ')
for (trn, tst) in k_fold:
    lda.fit(A[trn], y[trn])
    outVal = lda.score(A[tst], y[tst])
    #Compute classification error
print('Score: ' + str(outVal))